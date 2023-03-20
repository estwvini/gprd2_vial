<?php

namespace App\Http\Controllers\App\Api;


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\App\Client;
use App\Models\App\PasswordReset;
use Illuminate\Support\Facades\Validator;



class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function createPasswordReset(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email', 
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $user = Client::where('email', $request->email)->first();
        if (!$user)
            return response()->json(['message' => 'We cant find a user with that e-mail address.'], 404);
        
        
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60),
                'code' => rand ( 1000 , 9999 ),
             ]
        );
        if ($user && $passwordReset)
            
            $user->notify(
                new PasswordResetRequest($passwordReset->token, $passwordReset->code)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
            'token' => $passwordReset->token,
            'code' => $passwordReset->code,

        ]);
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }
    
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string',
            'code' => 'required'
            
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email],
            ['code', $request->code],
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset code is invalid.'
            ], 404);
        $user = Client::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        $user->password = bcrypt($request->password);
        $count_change= $user->changed_password;

        $user->changed_password =$count_change +1;
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        //return response()->json($user);
        return $this->response([$user]);
    }
}