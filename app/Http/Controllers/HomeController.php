<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\LoanPayment;
use App\LoanDetails;
use App\LoanRequest;
use App\ShareCapital;
use App\SavingsDeposit;
use App\Members;
use App\Expense;
use App\MemberDetails;
use App\LoanSchedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $payment = LoanPayment::sum('amount') + LoanPayment::sum('penalty');
        $penalty = LoanPayment::sum('penalty');
        $principal = LoanDetails::sum('loan_amount');
        $interest = LoanDetails::sum('total_interest');
        $loan = LoanDetails::sum('loan_amount') + LoanDetails::sum('total_interest');
        $receivable = $loan - ($payment - $penalty);
        
        $share_capital = ShareCapital::sum('amount');
        $expense = Expense::sum('amount');
        $savings = SavingsDeposit::sum('amount');
        $membership = 200*MemberDetails::where('member_fee', '1')->count();
        $processing_fee = 200*LoanDetails::count();

        $top_savings = SavingsDeposit::join('members', 'members.id', '=', 'savings_deposits.member_id')
        ->select(
            'savings_deposits.member_id',
            DB::raw('CONCAT(members.firstname, " ", members.lastname) as fullname'),
            DB::raw('SUM(amount) as total')
        )
        ->whereYear('savings_deposits.date', date('Y'))
        ->groupBy('savings_deposits.member_id', 'members.firstname', 'members.lastname')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
        
        $top_loan = LoanRequest::join('members', 'members.id', '=', 'loan_requests.member_id')
        ->select(
            'loan_requests.member_id',
            DB::raw('CONCAT(members.firstname, " ", members.lastname) as fullname'),
            DB::raw('SUM(loan_amount) as total')
        )
        ->whereYear('loan_requests.loan_date', date('Y'))
        ->groupBy('loan_requests.member_id', 'members.firstname', 'members.lastname')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        $total_fund = ($payment + $share_capital + $savings + $membership + $processing_fee) - ($loan + $expense);
        $celebrants = Members::with('details')->whereMonth('birthdate', date('m'))->orderByRaw('MONTH(birthdate), DAY(birthdate)')->get();

        $schedule = LoanSchedule::with('member')->where('status', 'draft')->whereMonth('date', date('m'))->orderBy('date','asc')->limit(10)->get();

        if($payment !== 0 || $loan !== 0 || $principal !== 0) {
            $percentage = [
                "payment" => ($payment / $loan) * 100,
                "receivable" => ($receivable / $loan) * 100,
                "principal" => ($principal / $loan) * 100,
                "interest" => ($interest / $loan) * 100,
                "penalty" => ($penalty / $loan) * 100,
            ];
        }
        else {
            $percentage = [
                "payment" => 100,
                "receivable" => 100,
                "principal" => 100,
                "interest" => 100,
                "penalty" => 100,
            ];
        }

        return view('admin.content.dashboard', compact('payment', 'loan', 'receivable', 'share_capital', 'savings', 'membership', 'processing_fee', 'schedule', 'total_fund', 'percentage', 'principal', 'interest', 'penalty', 'celebrants', 'top_savings', 'top_loan', 'expense'));
    }


}
