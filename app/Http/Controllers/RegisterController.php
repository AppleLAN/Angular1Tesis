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
        
        // If client record is from user's company set isData as True
        $credentials['isData'] = 1;

        try {
            $user = User::create($credentials);
            $client = new Clients();
            $client->name = '';
            $client->userId = $user->id;

            // If client record is from user's company set isData as False
            $client->isData = 1;
            $client->fantasyName = '';
            $client->email = '';
            $client->place = '';
            $client->address = '';
            $client->telephone = null;
            $client->cuit = '';
            $client->web = '';
            $client->codigoPostal = '';
            $client->iib = '';
            $client->pib = '';
            $client->epib = '';
            $client->responsableInscripto = false;
            $client->excento = false;
            $client->responsableMonotributo = false;
            $client->ivaInscripto = false;
            $client->precioLista = null;
            $client->condicionDeVenta = '';
            $client->limiteDeCredito = null;
            $client->numeroDeInscripcionesIB = null;
            $client->cuentasGenerales = '';
            $client->percepcionDeGanancia = null;            
            $client->save();
        } catch (\Illuminate\Database\QueryException $e) {
            return Response::json(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            return Response::json(['error' => 'La concha de tu madre allboys'], HttpResponse::HTTP_CONFLICT);
        }

        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token'));
    }
}
