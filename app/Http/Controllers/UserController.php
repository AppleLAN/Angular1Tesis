<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use RuntimeException;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\SupportsBasicAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Illuminate\Contracts\Cookie\QueueingFactory as CookieJar;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getUsers() {
    $users=User::all();
      if ($users){
        $usersArray = [];
        foreach ($users as $user) {
         $usersArra[] = $user->email;
        }
        return response()->json(["Status"=>"Ok","data"=>$usersArray],200);
      }else{
        return response()->json(["Status"=>"No Content"],204);
      }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserApps()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
            $apps = (object) [
                'sales' => $user->sales,
                'stock' => $user->stock,
                'clients' => $user->clients,
                'providers' => $user->providers,
            ];
            return response()->json(['apps' => $apps], 200);
        }
        else return response()->json(['error' => 'no_user_found'], 500);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user){
            $user->usrUsername = $request->usrUsername;
            $user->usrName = $request->usrName;
            $user->usrLastName = $request->usrLastName;
            $user->usrEmail = $request->usrEmail;
            $user->usrBirthday = $request->usrBirthday;
            $user->usrPassword = $request->usrPassword;
        }
        else{
            return response()->json(["Status" => "No Content"],204);
        }
        if ($user->save()){
            return response()->json(["Status" => "Cambios en carpeta guardados"],200);
        }else{
            return response()->json(["Status" => "Error al guardar los cambios en el usuario"],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
     public function getLoginID(){
        if (Auth::check()){
            $id=Auth::id();
            return response()->json(["Status" => "Ok","data" => $id],200);
        }
        else{
            return response()->json(["Status" => "Unauthorized"],401);
        }
    }
}
