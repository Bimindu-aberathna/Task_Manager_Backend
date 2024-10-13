<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log as FacadesLog;

class Auth_ToDo_Controller extends Controller
{
   
    /**
     *Register New User
     * @param App\Requests\RegisterRequest $request
     * @return JSONResponse
     */
    public function register(RegisterRequest $request)
    {
    //    dd($request->all());
       try {
      $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phone_number'=> $request->phone_number,

        ]);
        if ($user) {
           return ResponseHelper::success(message:'User has been registered successfully', data:$user, statusCode:201);
           
        }
        return ResponseHelper::success(message:'Unable to register',statusCode:400);
    } catch (\Throwable $e) {
        FacadesLog::error('Unable to register :'.$e->getMessage().$e->getLine());
        return ResponseHelper::success(message:'Unable to register'.$e->getMessage(),statusCode:500);
       }
    }


    /**
     * Login User
     *  @param App\Requests\LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        // dd($request->all());
        try {
            // if credentials are correct
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                FacadesLog::error('Login attempt failed for email: ' . $request->email);
                return ResponseHelper::error(message: 'Invalid credentials');
            }
           $user = Auth::user();
        //    dd($user);
           //create api token
           $token = $user->createToken('My API Token')->plainTextToken;
           $authUser = [
            'user' => $user,
            'token' => $token
           ];
           return ResponseHelper::success(message:'User has been registered successfully', data:$authUser, statusCode:200);
        } catch (Exception $e) {
            FacadesLog::error('Unable to login: ' . $e->getMessage() . ' at line ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to login: ' . $e->getMessage(), statusCode: 400);
        }
    }

    /**
     * Auth data , profile data
     */
    public function userProfile(string $id)
    {
        try {
           dd(Auth::user());
        } catch (Exception $e) {
            FacadesLog::error('Unable to connect user profile: ' . $e->getMessage() . ' at line ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to connect user profile: ' . $e->getMessage(), statusCode: 400);
        }
    }
}
