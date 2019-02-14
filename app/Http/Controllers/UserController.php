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
use Illuminate\Http\Response as HttpResponse;
use App\User;
use Hash;
use App\Enums\UserRole;
use App\UserRoles;
use DB;

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
            $apps = new \Illuminate\Database\Eloquent\Collection;
            $apps->add((object) ['app'=>'sales', 'active' => $user->sales]);
            $apps->add((object) ['app'=>'stock', 'active' => $user->stock]);
            $apps->add((object) ['app'=>'clients', 'active' => $user->clients]);
            $apps->add((object) ['app'=>'providers', 'active' => $user->providers]);
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

    public function createInternalUser(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user){
            $credentials = $request->only('birthday', 'company_id', 'lastname','name','username','email','password','address','sales','stock','clients','providers');
            $credentials['password'] = Hash::make( $credentials['password'] );
            try {
                $existentUser = User::where('email', $credentials['email'])->first();
                if ($existentUser) {
                    return response()->json(['error'=> "Ya existe un usuario con el email ingresado"], 500);
                } else {
                    $newUser = User::create($credentials);
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['error'=>$e->getMessage()], 500);
            } catch (\Exception $e) {
                return response()->json(['error'=> 'Error guardando la información del usuario'], 500);
            }

            $role = new UserRoles();
            $role->user_id = $newUser->id;
            $role->role_id = UserRole::NORMAL_USER;
            $role->save();
        
            return response()->json(['success' => 'Saved successfully'], 200);
        } 
        
        else return response()->json(['error' => 'no_user_found'], 500);

    }

    public function getAllInternalUsers() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
            try {
                $subUsers = DB::table('users')
                ->where('company_id', $user->company_id)
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id') 
                ->where('user_roles.role_id', UserRole::NORMAL_USER)
                ->get();
            } catch (\Exception $e) {
				return response()->json(['Error' => 'Error: "'.$e->getMessage().'" obteniendo usuarios internos'], 500);				
			}
            $r = new ApiResponse();
            $r->success = true;
            $r->message = "Usuarios Internos obtenidos exitosamente";
            $r->code = 200;
            $r->data = $subUsers;

            return $r->doResponse();
        }
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
