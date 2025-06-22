<?php

namespace App\Http\Controllers;

use Auth;
use App\DamayanFund;
use Illuminate\Http\Request;

class DamayanFundController extends Controller
{
    public function index()
    {
        return view('admin.content.damayan_fund');
    }

    public function get(Request $request)
    {
        $query = DamayanFund::with('member');

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
            'amount' => ['required'],
            'date' => ['required']
        ]);

        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        $record = DamayanFund::create($request->all());

    }
    
    public function edit($id)
    {
        $record = DamayanFund::with('member')->where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        DamayanFund::find($id)->update($request->except('_token'));

        return response()->json();
    }

    public function destroy($id)
    {
        $record = DamayanFund::find($id);
        $record->delete();

        return response()->json();
    }
}
