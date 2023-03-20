<?php

namespace App\Http\Controllers\App\Api;


use App\Models\System\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->response(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::where('username', request('email'))->first();

        if ($user == null || $user->enabled == 0 || !$user->can('index.app')) {
            return $this->response(['error' => 'Unauthorised'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Auth::guard('web')->attempt(['username' => request('email'), 'password' => request('password')])) {
            $user = Auth::guard('web')->user();

            $success['token'] = $user->createToken('AppName')->accessToken;
            $success['client_id'] = $user->id;
            return $this->response($success);
        } else {
            return $this->response(['error' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
