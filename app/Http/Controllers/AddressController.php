<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $address = Address::where('user_id', auth()->user()->id)->exists() ? Address::where('user_id', auth()->user()->id)->get() : null;
        return view('users/address', compact(['user', 'address']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_1' => ['required', 'max:50'],
            'address_2' => ['nullable', 'max:50'],
            'city' => ['required', 'regex:/^[A-Za-z\s]*$/'],
            'state' => ['required', 'regex:/^[A-Za-z\s]*$/'],
            'postal_code' => ['required', 'numeric', 'digits:5'],
            'country' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('address')
                ->withErrors($validator)
                ->withInput();
        } else {
            Address::insert([
                'address_line1' => $request->address_1,
                'address_line2' => $request->address_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('address');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'address_1_edit' => ['required', 'max:50'],
            'address_2_edit' => ['nullable', 'max:50'],
            'postal_code_edit' => ['required', 'numeric', 'digits:5'],
            'city_edit' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'state_edit' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'country_edit' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('address')
                ->withErrors($validator)
                ->withInput();
        } else {
            Address::where('id', $id)->update([
                'address_line1' => $request->address_1_edit,
                'address_line2' => $request->address_2_edit,
                'city' => $request->city_edit,
                'state' => $request->state_edit,
                'postal_code' => $request->postal_code_edit,
                'country' => $request->country_edit,
                'user_id' => auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('address');
    }

    public function destroy($id)
    {
        Address::where('id', $id)->delete();
        return redirect()->route('address');
    }

    public function dataAddress(Request $request)
    {
        return Address::where('id', $request->id)->get();
    }
}
