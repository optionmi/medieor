<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PeterColes\Countries\CountriesFacade as Countries;

class UserController extends Controller
{
    public function myProfile()
    {
        $user = auth()->user();
        $countries = Countries::lookup('en');
        return view('my-profile', compact('user', 'countries'));
    }

    public function updateDetails(Request $request, User $user)
    {
        $validator = validator()->make(
            $request->only(['name', 'email', 'country', 'phone']),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'country' => 'required',
                'phone' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->country = $request->country;
            $user->phone = $request->phone;

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/user_avatar'), $file_name);
                $user->img = $file_name;
            }

            $user->save();

            return response()->json(['message' => 'Profile updated']);
        } catch (\Exception $e) {
            return response()->json(['errors' => ['general' => 'Failed to update profile. Please try again.']], 422);
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        if (!Hash::check($request->input('currentPassword'), $user->password)) {
            return response()->json(['errors' => ['currentPassword' => ['Current password is incorrect']]], 422);
        }

        $validator = validator()->make($request->only(['currentPassword', 'password', 'password_confirmation']), [
            'currentPassword' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $user->update(['password' => Hash::make($request->get('password'))]);

        return response()->json(['message' => 'Password updated']);
    }
}
