<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.content.role');
    }

    public function get(Request $request)
    {
        $query = Role::query();

        if ($search = $request->input('search')) {
            $query->whereRaw("name LIKE ?", ["%{$search}%"]);
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
            'name' => ['required']
        ]);

        $request['guard_name'] = 'web';

        $record = Role::create($request->all());

    }
    
    public function edit($id)
    {
        $record = Role::where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        Role::find($id)->update($request->except('_token'));

        return response()->json();
    }

    public function destroy($id)
    {
        $record = Role::find($id);
        $record->delete();

        Role::where('id', $id)->delete();

        return response()->json();
    }
}
