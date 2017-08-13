<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Providers;
use App\User;
use App\Companies;
use App\Enums\UserRole;
use Hash;

class ProvidersController extends Controller
{
    public function getProviders() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
           return Providers::where('company_id',$user->company_id)->get(); 
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

        if ($user) {

            $data = $request->all();
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

    public function deleteProvider(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            $data = $request->all();
            Providers::where('id',$data['id'])->delete();

            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
