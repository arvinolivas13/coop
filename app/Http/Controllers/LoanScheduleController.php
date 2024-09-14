<?php

namespace App\Http\Controllers;

use Auth;
use App\LoanSchedule;
use Illuminate\Http\Request;

class LoanScheduleController extends Controller
{
    public function index()
    {
        return view('admin.content.schedule');
    }

    public function get(Request $request)
    {
        $query = LoanSchedule::with('member')->where('status', 'draft')->orderBy('date','asc');

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
