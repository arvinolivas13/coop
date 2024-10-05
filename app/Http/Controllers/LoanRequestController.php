<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use DateTimeZone;
use DateInterval;
use App\LoanRequest;
use App\LoanDetails;
use App\LoanSchedule;
use App\LoanPayment;
use App\LoanRequestDetails;
use App\Transactions;
use Illuminate\Http\Request;

class LoanRequestController extends Controller
{
    public function index()
    {
        return view('admin.content.loan_request');
    }

    public function get(Request $request)
    {
        $query = LoanRequest::with('member', 'comaker')
        ->join('members', 'loan_requests.member_id', '=', 'members.id');

        if ($search = $request->input('search')) {
            $query->whereRaw("CONCAT(members.firstname, ' ', members.middlename, ' ', members.lastname) LIKE ?", ["%{$search}%"]);
        }
        
        $total = $query->count();
        $rows = $query->select('loan_requests.*')->skip($request->input('offset'))->take($request->input('limit'))->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }

    public function save(Request $request)
    {
        $validate = $request->validate([
            'income_type' => ['required'],
            'income_amount' => ['required'],
            'payment_frequency' => ['required'],
            'no_of_payment' => ['required'],
            'loan_amount' => ['required'],
            'loan_date' => ['required'],
            'co_maker_id' => ['required']
        ]);

        $request['status'] = 'draft';
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        $record = LoanRequest::create($request->all());
        
        if($request->purpose) {
            foreach($request->purpose as $item) {
                $data = [
                    "loan_request_id" => $record->id,
                    "loan_purpose" => $item['loan_purpose'],
                    "amount" => $item['amount'],
                ];
    
                LoanRequestDetails::create($data);
            }
        }

        return response()->json(compact('validate'));
    }

    public function edit($id)
    {
        $record = LoanRequest::with('member', 'comaker', 'details')->where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }


    public function update(Request $request, $id)
    {
        LoanRequest::find($id)->update($request->all());
        
        if($request->purpose) {
            foreach($request->purpose as $item) {
                $data = [
                    "loan_request_id" => $id,
                    "loan_purpose" => $item['loan_purpose'],
                    "amount" => $item['amount'],
                ];
    
                LoanRequestDetails::create($data);
            }
        }

        return response()->json();
    }

    public function destroy($id)
    {
        $record = LoanRequest::find($id);
        $record->delete();

        MemberBeneficiary::where('member_id', $id)->delete();

        return response()->json();
    }
    
    public function destroyPurpose($id)
    {
        $record = LoanRequestDetails::find($id);
        $record->delete();
        

        return response()->json();
    }

    public function approve($id) {
        $request = LoanRequest::where('id', $id)->first();

        $date = new DateTime($request->loan_date);
        $first = new DateTime($request->loan_date);
        $range = new DateTime($request->loan_date);

        $amount = floatval($request->loan_amount / $request->no_of_payment);

        $i_rate = 0;
        $p_rate = 0;
        $ir = 4;
        $pr = 5;
        $interval = "";
        $dt_i = "";

        $penalty = 0;
        $interest_in = 0;
        $partial_in = 0;
        $total_partial = 0;
        $total_interest = 0;
        $last_partial = 0;
        $last_interest = 0;
        $penalty_2 = 0;
        $months = null;

        switch($request->payment_frequency) {
            case "monthly":
                $i_rate = ($ir / 1) / 100;
                $p_rate = (($pr / 1) / 100)/30;

                $interval = "months";
                $first = $first->modify("+1 " . $interval);
                $range = $range->modify("+" . $request->no_of_payment . " " . $interval);
                $dt_i = "P1M";

                break;

            case "semi_monthly":
                $i_rate = ($ir / 2)/ 100;
                $p_rate = (($pr / 2) / 100)/15;

                $interval = "semi-months";
                $first = $first->modify("+15 days");
                $range = $range->modify("+" . 15*$request->no_of_payment . " days");
                $dt_i = "P15D";
                break;

            case "weekly":
                // loan * interest_rate * no_month / no_of_days * 7
                $months = round($request->no_of_payment / 4.345);

                $interest_in = ((($request->loan_amount * ($ir / 100)) * $months) / ($months * 30)) * 7;
                $partial_in = ($request->loan_amount/($months * 30)) * 7;

                $penalty_2 = ($interest_in + $partial_in) * ($pr / 100) / 30;

                $total_partial_2 = $partial_in * ($request->no_of_payment - 1);
                $total_interest_2 = $interest_in * ($request->no_of_payment - 1);

                $last_partial = $request->loan_amount - $total_partial_2;
                $last_interest = ($request->loan_amount * ($ir / 100) * $months) - $total_interest_2;

                // $i_rate = ($ir / 4.33)/ 100;
                // $p_rate = (($pr / 4.33) / 100)/7;

                $interval = "weeks";
                $first = $first->modify("+1 " . $interval);
                $range = $range->modify("+" . ($request->no_of_payment - 1) . " " . $interval);
                $dt_i = "P1W";
                break;

            case "daily":
                $i_rate = ($ir / 30)/ 100;
                $p_rate = (($pr / 30) / 100)/1;

                $interval = "days";
                $first = $first->modify("+1 " . $interval);
                $range = $range->modify("+" . $request->no_of_payment . " " . $interval);
                $dt_i = "P1D";
                break;
        }
        

        $interval_2 = new DateInterval($dt_i);
        $currentDate = clone $first;
        $endDate = clone $range;

        $interest = $request->loan_amount*$i_rate;
        $penalty = $request->loan_amount*$p_rate;
        $payment = $amount + $interest;
        $total_interest = ($interest) * $request->no_of_payment;

        $data_details = array(
            "member_id" => $request->member_id,
            "loan_request_id" => $id,
            "interest_rate" => $ir,
            "penalty_rate" => $pr,
            "date_avail" => $date->format('Y-m-d'),
            "first_payment" => $first->format('Y-m-d'),
            "due_date" => $endDate->format('Y-m-d'),
            "loan_amount" => $request->loan_amount,
            "total_interest" => $request->payment_frequency !== "weekly"?floatval($total_interest):floatval($total_interest_2 + $last_interest),
            "net_proceeds" => floatval($request->loan_amount),
            "weekly_payment" => $request->payment_frequency !== "weekly"?floatval($payment):floatval(($total_partial_2 + $last_partial) + ($total_interest_2 + $last_interest)),
            "penalty_amount" => $request->payment_frequency !== "weekly"?$penalty:$penalty_2,
            "processing_fee" => 200,
            "created_by" => Auth::user()->id,
            "updated_by" => Auth::user()->id,
        );

        $details = LoanDetails::create($data_details);

        while ($currentDate <= $range) {
            $data = array(
                "member_id" => $request->member_id,
                "loan_details_id" => $details->id,
                "date" => $currentDate->format('Y-m-d'),
                "principal_amount" => $request->payment_frequency !== "weekly"?$amount:$partial_in,
                "interest_amount" => $request->payment_frequency !== "weekly"?$interest:$interest_in,
                "amount" => $request->payment_frequency !== "weekly"?$payment:($partial_in + $interest_in),
                "approved_by" => null,
                "approved_date" => null,
                "status" => "draft",
            );

            LoanSchedule::create($data);

            $currentDate->add($interval_2);
        }

        if($request->payment_frequency === "weekly") {
            $data = array(
                "member_id" => $request->member_id,
                "loan_details_id" => $details->id,
                "date" => $currentDate->format('Y-m-d'),
                "principal_amount" => $last_partial,
                "interest_amount" => $last_interest,
                "amount" => $last_partial + $last_interest,
                "approved_by" => null,
                "approved_date" => null,
                "status" => "draft",
            );

            LoanSchedule::create($data);
        }

        LoanRequest::where('id', $id)->update(['status' => 'approve', 'approved_by' => Auth::user()->id, 'approved_date' => date('Y-m-d')]);
        

        return response()->json(compact('date', 'range', 'months'));
    }
    
    public function decline($id) {
        LoanRequest::where('id', $id)->update(['status' => 'decline', 'rejected_by' => Auth::user()->id, 'rejected_date' => date('Y-m-d')]);
    }
    
    public function release($id) {
        $loan = LoanRequest::where('id', $id)->first();
        LoanRequest::where('id', $id)->update(['status' => 'release', 'released_by' => Auth::user()->id, 'released_date' => date('Y-m-d')]);
        
        $transaction = array(
            "member_id" => $loan->member_id,
            "date" => date('Y-m-d'),
            "particulars" => "Loan",
            "amount" => $loan->loan_amount,
            "status" => "new",
            "remarks" => $loan->no_of_payment."(".$loan->payment_frequency.")"
        );

        Transactions::create($transaction);
        
        $transaction_2 = array(
            "member_id" => $loan->member_id,
            "date" => date('Y-m-d'),
            "particulars" => "Processing fee",
            "amount" => "200.00",
            "status" => "new"
        );

        Transactions::create($transaction_2);
    }

    public function getDetails($id) {
        $record = LoanDetails::with('loan', 'member', 'schedule', 'schedule.payment', 'schedule.payment.user')->where('loan_request_id', $id)->first();
        $total_payment = LoanPayment::join('loan_schedules', 'loan_schedules.id', '=', 'loan_payments.loan_schedule_id')
                    ->where('loan_schedules.loan_details_id', $record->id)
                    ->sum('loan_payments.amount');

        return response()->json(compact('record', 'total_payment'));
    }
    
    public function getLoanDetails($id) {
        $record = LoanDetails::with('loan', 'member', 'schedule', 'schedule.payment', 'schedule.payment.user')->where('id', $id)->first();
        $total_payment = LoanPayment::join('loan_schedules', 'loan_schedules.id', '=', 'loan_payments.loan_schedule_id')
                    ->where('loan_schedules.loan_details_id', $record->id)
                    ->sum('loan_payments.amount');

        return response()->json(compact('record', 'total_payment'));
    }

    public function getSchedule($id) {
        $record = LoanSchedule::with('details')->where('id', $id)->first();
        $total_payment = LoanPayment::join('loan_schedules', 'loan_schedules.id', '=', 'loan_payments.loan_schedule_id')
                    ->where('loan_schedules.loan_details_id', $record->loan_details_id)
                    ->sum('loan_payments.amount');

        return response()->json(compact('record', 'total_payment'));
    }

    public function savePayment(Request $request) {
        $validate = $request->validate([
            'date' => ['required'],
            'receipt_no' => ['required'],
        ]);
        
        $request['received_by'] = Auth::user()->id;
        $record = LoanSchedule::where('id', $request->loan_schedule_id)->first();

        LoanPayment::create($request->all());
        LoanSchedule::where('id', $request->loan_schedule_id)->update(["status" => "paid", "approved_by" => Auth::user()->id, "approved_date" => date('Y-m-d')]);
        
        $total_payment = LoanPayment::join('loan_schedules', 'loan_schedules.id', '=', 'loan_payments.loan_schedule_id')
                    ->where('loan_schedules.loan_details_id', $record->loan_details_id)
                    ->sum('loan_payments.amount');
                    
        $transaction = array(
            "member_id" => $request->member_id,
            "date" => $request->date,
            "particulars" => "Principal Payment",
            "amount" => $record->principal_amount,
            "status" => "new"
        );

        Transactions::create($transaction);
        
        $transaction_2 = array(
            "member_id" => $request->member_id,
            "date" => $request->date,
            "particulars" => "Interest Payment",
            "amount" => $record->interest_amount,
            "status" => "new"
        );

        Transactions::create($transaction_2);

        return response()->json(compact('total_payment'));
    }

    public function saveEdit(Request $request) {
    
        foreach($request->sched as $item) {
            LoanSchedule::where('id', $item['id'])->update([
                'date' => $item['date'],
                'principal_amount' => $item['principal_amount'],
                'interest_amount' => $item['interest_amount'],
                'amount' => floatval($item['principal_amount'] + $item['interest_amount'])
            ]);
        }

        $interest = round(LoanSchedule::where('loan_details_id', $request->id)->sum('interest_amount'));
        $payment = LoanSchedule::where('loan_details_id', $request->id)->orderBy('id', 'asc')->first();

        LoanDetails::where('id', $request->id)->update([
            'weekly_payment' => $payment->amount,
            'total_interest' => $interest
        ]);
    }

}
