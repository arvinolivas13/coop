<?php

namespace App\Http\Controllers;

use Auth;
use App\DamayanFundExpense;
use Illuminate\Http\Request;

class DamayanFundExpenseController extends Controller
{
    public function index()
    {
        return view('admin.content.damayan_fund_expense');
    }

    public function get(Request $request)
    {
        $query = DamayanFundExpense::query();

        if ($search = $request->input('search')) {
            $query->whereRaw("title LIKE ?", ["%{$search}%"]);
        }
        
        $total = $query->count();
        $rows = $query->skip($request->input('offset'))->take($request->input('limit'))->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }

    public function save(Request $request) {
        
        $validate = $request->validate([
            'title' => ['required'],
            'details' => ['required'],
            'amount' => ['required'],
            'date' => ['required']
        ]);

        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        $record = DamayanFundExpense::create($request->all());

    }
    
    public function edit($id)
    {
        $record = DamayanFundExpense::where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        DamayanFundExpense::find($id)->update($request->except('_token'));

        return response()->json();
    }

    public function destroy($id)
    {
        $record = DamayanFundExpense::find($id);
        $record->delete();

        return response()->json();
    }
}
