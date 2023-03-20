<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use Carbon\Carbon;

class ProfileUpdateController extends Controller
{
    public function update(ProfileUpdateRequest $request){
        $user = $request->user();
        $validatedData = $request->validated();        
        //Cannot update 'birth_date' with the format of 'm-d-Y'?
        $user->update($validatedData);
        $user->refresh();
        $success['user'] = $user;
        $success['success'] = true;
                
        return response()->json($success,200);
    }
}
