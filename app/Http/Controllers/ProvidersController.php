<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Providers;
use App\Products;
use App\User;
use App\Companies;
use App\Enums\UserRole;
use Hash;
use Carbon\Carbon;

class ProvidersController extends Controller
{
    public function getProviders() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
            return Providers::where('company_id',$user->company_id)->whereNull('deleted_at')->get();
        }
    }

    public function saveProvider(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            try {
                $data = $request->all();
                $provider = new Providers();
                $provider->name = $data['name'];
                $provider->company_id = $user->company_id;
                $provider->fantasyName = $data['fantasyName'];
                $provider->email = $data['email'];
                $provider->place = $data['place'];
                $provider->address = $data['address'];
                $provider->telephone = $data['telephone'];
                $provider->cuit = $data['cuit'];
                $provider->web = $data['web'];
                $provider->codigoPostal = $data['codigoPostal'];
                $provider->iib = $data['iib'];
                $provider->pib = $data['pib'];
                $provider->epib = $data['epib'];
                $provider->responsableInscripto = $data['codigoProvincia'];
                $provider->excento = $data['excento'];
                $provider->responsableMonotributo = $data['responsableMonotributo'];
                $provider->ivaInscripto = $data['ivaInscripto'];
                $provider->precioLista = $data['precioLista'];
                $provider->condicionDeVenta = $data['condicionDeVenta'];
                $provider->limiteDeCredito = $data['limiteDeCredito'];
                $provider->numeroDeInscripcionesIB = $data['numeroDeInscripcionesIB'];
                $provider->cuentasGenerales = $data['cuentasGenerales'];
                $provider->percepcionDeGanancia = $data['percepcionDeGanancia'];            

                $provider->save();
            }  catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }

            return response()->json(['success' => 'Saved successfully'], 200);
        }
    }

    public function updateProvider(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
        if ($user) {

            $data = $request->all();

            $existentProvider = Providers::where('fantasyName','=', $data['fantasyName'])->where('name','=', $data['name'])->where('company_id','=', $user->company_id)->first();
            if ($existentProvider) {
                return response()->json(['error'=> "Ya existe un proveedor con ese nombre o nombre de fantasia"], 500);
            } else {
                try {
                    $provider = Providers::where('id',$data['id'])->where('company_id',$user->company_id)->first();
                        $provider->name = $data['name'];
                        $provider->company_id = $user->company_id;                
                        $provider->fantasyName = $data['fantasyName'];
                        $provider->email = $data['email'];
                        $provider->place = $data['place'];
                        $provider->codigoPostal = $data['codigoPostal'];
                        $provider->codigoProvincia = $data['codigoProvincia'];
                        $provider->address = $data['address'];
                        $provider->telephone = $data['telephone'];
                        $provider->cuit = $data['cuit'];
                        $provider->web = $data['web'];
                        $provider->codigoPostal = $data['codigoPostal'];
                        $provider->iib = $data['iib'];
                        $provider->pib = $data['pib'];
                        $provider->epib = $data['epib'];
                        $provider->responsableInscripto = $data['codigoProvincia'];
                        $provider->excento = $data['excento'];
                        $provider->responsableMonotributo = $data['responsableMonotributo'];
                        $provider->ivaInscripto = $data['ivaInscripto'];
                        $provider->precioLista = $data['precioLista'];
                        $provider->condicionDeVenta = $data['condicionDeVenta'];
                        $provider->limiteDeCredito = $data['limiteDeCredito'];
                        $provider->numeroDeInscripcionesIB = $data['numeroDeInscripcionesIB'];
                        $provider->cuentasGenerales = $data['cuentasGenerales'];
                        $provider->percepcionDeGanancia = $data['percepcionDeGanancia'];            

                    $provider->save();

                    return response()->json(['success' => 'Updated successfully'], 200);
                } catch (\Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 401);
                } 
            }
        }
    }

    public function deleteProvider(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
        if ($user) {
            $data = $request->all();
            $hasProducts = Products::where('provider_id',$data['id'])->where('company_id',$user->company_id)->whereNull('deleted_at')->first()
            if ($hasProducts) {
                return response()->json(['error'=> "El proveedor posee productos para este usuario, por favor eliminarlos primero"], 500);
            } else {
                $provider = Providers::where('id',$data['id'])->first();
                $provider->deleted_at = Carbon::now();
                $provider->save();
                return response()->json(['success' => 'Deleted successfully'], 200);            
            }
        }
    }
}
