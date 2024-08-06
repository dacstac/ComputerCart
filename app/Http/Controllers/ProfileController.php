<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('users/profile', compact('user'));
    }

    public function createAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pass' => ['required', 'between:5,20'],
            'email_create' => ['required', 'unique:users,email', 'email:rfc,dns'],
            'name' => ['required', 'alpha:ascii'],
            'phone' => ['required', 'unique:users,phone_number', 'digits:9'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('startLogin')
                ->withErrors($validator)
                ->withInput();
        } else {
            User::insert([
                'name' => $request->name,
                'password' => Hash::make($request->pass),
                'email' => $request->email,
                'phone_number' => $request->phone,
                'type' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('home');
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'alpha:ascii'],
            'email' => ['required', $request->email != auth()->user()->email ? 'unique:users,email' : '', 'email:rfc,dns'],
            'phone' => ['required', $request->phone != auth()->user()->phone_number ? 'unique:users,phone_number' : '', 'digits:9'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', auth()->user()->id)->update([
                'email' => $request->email,
                'name' => $request->name,
                'phone_number' => $request->phone,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('profile');
    }
}
