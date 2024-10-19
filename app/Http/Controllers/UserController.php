<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Role;
use App\ModelHasRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        return view('admin.content.user', compact('roles'));
    }

    public function get(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->whereRaw("name LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("email LIKE ?", ["%{$search}%"]);
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
            'email' => ['required']
        ]);

        $request['password'] = Hash::make('password123');

        $record = User::create($request->all());

        $has_role = array(
            'role_id' => $request->role_id,
            'model_type' => 'App\User',
            'model_id' => $record->id,
        );

        ModelHasRole::create($has_role);

    }
    
    public function edit($id)
    {
        $record = User::with('hasRole', 'hasRole.role')->where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }
    
    public function update(Request $request, $id)
    {
        User::find($id)->update($request->except('_token'));

        if(ModelHasRole::where('model_id', $id)->count() === 0)  {
            $has_role = array(
                'role_id' => $request->role_id,
                'model_type' => 'App\User',
                'model_id' => $id,
            );
    
            ModelHasRole::create($has_role);
        }
        else {
            $has_role = array(
                'role_id' => $request->role_id,
                'model_type' => 'App\User',
                'model_id' => $id,
            );

            ModelHasRole::where('model_id', $id)->update($has_role);
        }

        return response()->json();
    }

    public function destroy($id)
    {
        $record = User::find($id);
        $record->delete();

        User::where('id', $id)->delete();
        ModelHasRole::where('model_id', $id)->delete();

        return response()->json();
    }
}
