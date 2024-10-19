<?php

namespace App\Http\Controllers;

use Auth;
use App\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.reports.transaction');
    }

    public function get(Request $request)
    {   
        $query = Transactions::with('member')->orderBy('date','asc')
        ->join('members', 'transactions.member_id', '=', 'members.id');

        if ($search = $request->input('search')) {
            $query->whereRaw("CONCAT(members.firstname, ' ', members.middlename, ' ', members.lastname) LIKE ?", ["%{$search}%"]);
        }
        
        $total = $query->count();
        $rows = $query->select('transactions.*')->skip($request->input('offset'))->take($request->input('limit'))->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }
}
