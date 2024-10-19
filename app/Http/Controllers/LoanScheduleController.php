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
        $query = LoanSchedule::with('member')
        ->join('members', 'loan_schedules.member_id', '=', 'members.id')->where('loan_schedules.status', 'draft')->orderBy('loan_schedules.date','asc');

        if ($search = $request->input('search')) {
            $query->whereRaw("CONCAT(members.firstname, ' ', members.middlename, ' ', members.lastname) LIKE ?", ["%{$search}%"]);
        }
        
        $total = $query->count();
        $rows = $query->select('loan_schedules.*')->skip($request->input('offset'))->take($request->input('limit'))->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }
}
