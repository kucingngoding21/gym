<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $member = User::where('id',$user->id)->first();

            $success['token'] = $user->createToken('nApp')->accessToken;
            $user_encrypt['token'] = Crypt::encryptString($user->id);
            $user_encrypt['data'] = $member;

            $member->save();

            return response()->json(['statusCode' => 200,'success' => true, 'message' => 'sudah masuk', 'data' => $user_encrypt], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
