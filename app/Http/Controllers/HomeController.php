<?php

namespace App\Http\Controllers;

use App\LoanPayment;
use App\LoanDetails;
use App\ShareCapital;
use App\SavingsDeposit;
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
        $payment = LoanPayment::sum('amount');
        $loan = LoanDetails::sum('loan_amount') + LoanDetails::sum('total_interest');
        $receivable = $loan - $payment;
        
        $share_capital = ShareCapital::sum('amount');
        $savings = SavingsDeposit::sum('amount');
        $membership = 200*MemberDetails::where('member_fee', '1')->count();
        $processing_fee = 200*LoanDetails::count();

        $total_fund = ($payment + $share_capital + $savings + $membership + $processing_fee) - $loan;

        $schedule = LoanSchedule::with('member')->where('status', 'draft')->orderBy('date','asc')->limit(10)->get();

        if($payment === 0 || $loan === 0) {
            
            $percentage = [
                "payment" => ($payment / $loan) * 100,
                "receivable" => ($receivable / $loan) * 100,
            ];
        }
        else {
            $percentage = [
                "payment" => 100,
                "receivable" => 100,
            ];
        }

        return view('admin.content.dashboard', compact('payment', 'loan', 'receivable', 'share_capital', 'savings', 'membership', 'processing_fee', 'schedule', 'total_fund', 'percentage'));
    }


}
