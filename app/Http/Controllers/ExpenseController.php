<?php

namespace App\Http\Controllers;

use Auth;
use App\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    
    public function index()
    {
        return view('admin.content.expense');
    }

    public function get(Request $request)
    {
        $query = Expense::query();

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

        $record = Expense::create($request->all());

    }
    
    public function edit($id)
    {
        $record = Expense::where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        Expense::find($id)->update($request->except('_token'));

        return response()->json();
    }

    public function destroy($id)
    {
        $record = Expense::find($id);
        $record->delete();

        return response()->json();
    }
}
