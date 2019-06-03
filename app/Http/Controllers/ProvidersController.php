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
        $data = $request->all();

        if ($user) {
            $existentProviderFantasyName = Providers::where('fantasyName','=', $data['fantasyName'])->where('company_id','=', $user->company_id)->whereNull('deleted_at')->first();
            $existentProviderCuit = Providers::where('cuit','=', $data['cuit'])->where('company_id','=', $user->company_id)->whereNull('deleted_at')->first();
            if ($existentProviderFantasyName) {
                return response()->json(['error'=> "Ya existe un proveedor con mismo nombre de fantasia"], 500);
            } else if ($existentProviderCuit) {
                return response()->json(['error'=> "Ya existe un proveedor con mismo C.U.I.T"], 500);
            } else {
                try {
                    $provider = new Providers();
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
                    $provider->tipoDocumento = $data['tipoDocumento'];
                    $provider->documento = $data['documento'];
                    $provider->ganancia = $data['ganancia'];
                    $provider->web = $data['web'];
                    $provider->responsableInscripto = $data['responsableInscripto'];
                    $provider->excento = $data['excento'];
                    $provider->responsableMonotributo = $data['responsableMonotributo'];
                    $provider->cuentasGenerales = $data['cuentasGenerales'];
                    $provider->G = $data['G'];
                    $provider->IIBB = $data['IIBB'];
                    $provider->IVA = $data['IVA'];
                    $provider->SUS = $data['SUS'];
                    $provider->GPercentage = $data['GPercentage'];
                    $provider->IIBBPercentage = $data['IIBBPercentage'];
                    $provider->IVAPercentage = $data['IVAPercentage'];
                    $provider->SUSPercentage = $data['SUSPercentage'];

                    $provider->save();
                }  catch (\Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 401);
                }
            }
            return response()->json(['success' => $provider], 200);
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
                $provider->tipoDocumento = $data['tipoDocumento'];
                $provider->documento = $data['documento'];
                $provider->ganancia = $data['ganancia'];
                $provider->web = $data['web'];
                $provider->responsableInscripto = $data['responsableInscripto'];
                $provider->excento = $data['excento'];
                $provider->responsableMonotributo = $data['responsableMonotributo'];
                $provider->cuentasGenerales = $data['cuentasGenerales'];
                $provider->G = $data['G'];
                $provider->IIBB = $data['IIBB'];
                $provider->IVA = $data['IVA'];
                $provider->SUS = $data['SUS'];
                $provider->GPercentage = $data['GPercentage'];
                $provider->IIBBPercentage = $data['IIBBPercentage'];
                $provider->IVAPercentage = $data['IVAPercentage'];
                $provider->SUSPercentage = $data['SUSPercentage'];     

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
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
        if ($user) {
            $data = $request->all();
            $hasProducts = Products::where('provider_id',$data['id'])->where('company_id',$user->company_id)->whereNull('deleted_at')->first();
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
