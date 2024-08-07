<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create()
    {
        return view('admin/users/createUsers');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'alpha:ascii'],
            'password' => ['required', 'between:5,20'],
            'email' => ['required', 'unique:users,email', 'email:rfc,dns'],
            'phone' => ['required', 'unique:users,phone_number', 'digits:9'],
            'type' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('createUsers')
                ->withErrors($validator)
                ->withInput();
        } else {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone,
                'type_user' => $request->type,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('showUsers');
    }

    public function show()
    {
        return view('admin/users/showUsers');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('showUsers');
    }
}
