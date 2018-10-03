<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Hash;
use Response;
use App\User;
use App\Clients;
use App\Folder;
use App\Country;
use App\Province;
use App\City;
use App\Enums\UserRole;
use App\UserRoles;

class RegisterController extends Controller
{
    /**
     * Devuelve todas las carpetas relacionadas con el usuario loggeado
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $this->middleware('jwt.auth', ['except' => ['signup']]);
     }

    public function index(){

    }

    /**
     * Creacion de nueva carpeta para el usuario loggeado
     *
     * @return \Illuminate\Http\Response
     */
     public function signup(Request $request)
    {
        $credentials = $request->only('birthday','lastname','name','username','email','password','address','sales','stock','clients','providers');
        $credentials['password'] = Hash::make( $credentials['password'] );
        $credentials['company_id'] = null;

        try {
            $user = User::create($credentials);
        } catch (\Illuminate\Database\QueryException $e) {
            return Response::json(['error' => $e->getMessage()],500);
        } catch (\Exception $e) {
            return Response::json(['error' => 'Error saving user information'], HttpResponse::HTTP_CONFLICT);
        }

        $token = JWTAuth::fromUser($user);
        $user = JWTAuth::toUser($token);

        $role = new UserRoles();
        $role->user_id = $user->id;
        $role->role_id = UserRole::ADMIN;
        $role->save();

        return Response::json(compact('token'));
    }
}
