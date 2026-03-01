<?php

namespace App\Http\Controllers;

use Auth;
use App\LoanPayment;
use Illuminate\Http\Request;

class LoanPaymentController extends Controller
{
    public function index()
    {
        return view('admin.content.payment');
    }

    public function get(Request $request)
    {
        $query = LoanPayment::with('user', 'schedule', 'member')->orderBy('date','asc')
        ->join('members', 'loan_payments.member_id', '=', 'members.id');

        if ($search = $request->input('search')) {
            $query->whereRaw("CONCAT(members.firstname, ' ', members.middlename, ' ', members.lastname) LIKE ?", ["%{$search}%"]);
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->where('loan_payments.date', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->where('loan_payments.date', '<=', $dateTo);
        }
        
        $total = $query->count();
        $rows = $query->select('loan_payments.*')->skip($request->input('offset'))->take($request->input('limit'))->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }
    
    public function edit($id)
    {
        $record = LoanPayment::with('user', 'schedule', 'member')->where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        LoanPayment::find($id)->update($request->all());

        return response()->json();
    }
}
