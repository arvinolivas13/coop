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
        $query = LoanPayment::with('user', 'schedule', 'member')->orderBy('date','asc');

        // if ($search = $request->input('search')) {
        //     $query->whereRaw("CONCAT(firstname, ' ', middlename, ' ', lastname) LIKE ?", ["%{$search}%"]);
        //     $query->orWhereRaw("email_address LIKE ?", ["%{$search}%"]);
        //     $query->orWhereRaw("mobile_no LIKE ?", ["%{$search}%"]);
        //     $query->orWhereRaw("address LIKE ?", ["%{$search}%"]);
        //     $query->orWhereRaw("status LIKE ?", ["%{$search}%"]);
        // }
        
        $total = $query->count();
        $rows = $query->skip($request->input('offset'))->take($request->input('limit'))->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }
}
