<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use Otp;
use Auth;
use Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        // Get the current user
        $user = Auth::user();

        // Check if the user's password matches the current password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'The current password is incorrect.'], 400);
        }

        // Get the new password from the request payload
        $newPassword = $request->input('new_password');

        // Check if the new password is the same as the current password
        if ($request->current_password === $newPassword) {
            return response()->json(['error' => 'The new password cannot be the same as the current password.'], 400);
        }

        // Update the user's password
        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json(['message' => 'The password has been changed.'], 200);
    }
}
