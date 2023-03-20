<?php

namespace App\Http\Controllers\App\Api;


use Illuminate\Http\Request;
use App\Models\App\VisitClient;
use Carbon\Carbon;
use Exception;
use App\Models\App\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ClientController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request): JsonResponse
    {
        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'age' => 'required',
            //'date_birth' => 'required',
            'ethnicity' => 'required',
            'gender' => 'required',
            'canton' => 'required',
            'email'=> 'required|email',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $users = Client::where('email', '=', $request->input('email'))->first();
        if ($users === null) {
            $input = $validator->getData();
            $input['password'] = bcrypt($input['password']);
            $user = Client::create($input);
            $success['token'] = $user->createToken('AppName')->accessToken;
            $success['client_id'] = $user->id;
            return $this->response($success);
        } else {
            return $this->response(['error' => 'Correo ya Registrado'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        //return response()->json(['success' => $success], $this->successStatus);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
       
        $user = Client::where('email', $request->email)->first();

        
        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $data=[
                    'client_id'=>$user->id,
                    'visit_at' => Carbon::now(),
                ];
    
                VisitClient::create($data);
    
               

                $success['token'] = $user->createToken('AppName')->accessToken;
                $success['client_id'] = $user->id;
                return $this->response($success);
                //return response($response, 200);
            } else {
              
                //return $this->response($response,422);
                return $this->response(['error' => 'Unauthorised'], 422);
               
            }
    
        } else {
            return $this->response(['error' => 'Unauthorised'], 401);
           
        }

        /*if (Auth::guard('api-client')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::guard('api-client')->user();

            $data=[
                'client_id'=>$user->id,
                'visit_at' => Carbon::now(),
            ];

            VisitClient::create($data);

            $success['token'] = $user->createToken('AppName')->accessToken;
            $success['client_id'] = $user->id;
            return $this->response($success);

           // return response()->json(['success' => $success,'user'=>$userData], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }*/
    }

    //Cambio contraseña
    public function change(Request $request, $id): JsonResponse
    {
                
        $validator = Validator::make($request->all(), [
            'oldPass' => 'required',
            'password' => 'required',
            'confirmacionPass' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $user = Client::find($id);
            if (Hash::check($request->oldPass, $user->password)) {
                $user->password = Hash::make($request->password);
                //$user->confirmation = 1;
                $user->save();

                $datosResponse = [
                    'id' => $user->id,
                ];
                return response()->json(['success' => 'Contraseña Actualizada',$datosResponse], $this->successStatus);
                //return $this->successResponse($datosResponse, 'Contraseña Actualizada');

            } else {
                return response()->json(['success' => 'La contraseña anterior no es correcta'], $this->successStatus);
                //return $this->successResponse(1, 'La contraseña anterior no es correcta');
            }
        } catch (Exception $exception) {
            Log::debug($exception->getMessage());
           

            return response()->json(['error' => $exception->getMessage()], 401);
        }
    }

    public function profile($id): JsonResponse
    {
        try {
            $user = Client::find($id);

       

            $userData=[
                'client_id'=>$user->id,
                'name' => $user->full_name,
                'age' => $user->age,
                
                'ethnicity' => $user->ethnicity,
                'gender' => $user->gender,
                'canton' => $user->canton,
                'email'=> $user->email,
            
            ];
            return $this->response($userData);
        } catch (Exception $ex) {
            return $this->response(['error' => '' . $ex], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
       
        
        //return response()->json(['success' => $userData], $this->successStatus);
    }
}
