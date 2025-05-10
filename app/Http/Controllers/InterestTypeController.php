<?php

namespace App\Http\Controllers;

use Auth;
use App\InterestType;
use Illuminate\Http\Request;

class InterestTypeController extends Controller
{
    public function index()
    {
        return view('admin.content.interest_type');
    }

    public function get(Request $request)
    {
        $query = InterestType::query();

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
            'name' => ['required'],
            'rate' => ['required']
        ]);

        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        $record = InterestType::create($request->all());

    }
    
    public function edit($id)
    {

        $record = InterestType::where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'rate' => ['required']
        ]);
        
        InterestType::find($id)->update($request->except('_token'));

        return response()->json();
    }

    public function destroy($id)
    {
        $record = InterestType::find($id);
        $record->delete();

        return response()->json();
    }
}
