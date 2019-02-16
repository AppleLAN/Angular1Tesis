<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Companies;
use App\User;
use App\Enums\UserRoles;
use Hash;

class CompaniesController extends Controller
{
    public function IsGranted() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $role = HelpersController::checkUserRole($user->id);

        if ($user && $role->role_id == UserRole::ADMIN) {
            return true;
        } else {
            return false;
        }
    }

    public function getCompanyInfo() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user && $this->IsGranted()){
           return Companies::where('userId',$user->id)->get(); 
        }
    }

    public function saveCompanyInfo(Request $request){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user && $this->IsGranted()) {
                $data = $request->all();

                $companyInformation = new Companies();
                $companyInformation->name = $data['name'];
                $companyInformation->sale_point = $data['sale_point'];
                $companyInformation->start_date = $data['start_date'];
                $companyInformation->fantasyName = $data['fantasyName'];
                $companyInformation->email = $data['email'];
                $companyInformation->place = $data['place'];
                $companyInformation->codigoPostal = $data['codigoPostal'];
                $companyInformation->codigoProvincia = $data['codigoProvincia'];
                $companyInformation->address = $data['address'];
                $companyInformation->telephone = $data['telephone'];
                $companyInformation->cuit = $data['cuit'];
                $companyInformation->web = $data['web'];
                $companyInformation->iib = $data['iib'];
                $companyInformation->pib = $data['pib'];
                $companyInformation->epib = $data['epib'];
                $companyInformation->responsableInscripto = $data['responsableInscripto'];
                $companyInformation->excento = $data['excento'];
                $companyInformation->responsableMonotributo = $data['responsableMonotributo'];
                $companyInformation->ivaInscripto = $data['ivaInscripto'];
                $companyInformation->precioLista = $data['precioLista'];
                $companyInformation->condicionDeVenta = $data['condicionDeVenta'];
                $companyInformation->limiteDeCredito = $data['limiteDeCredito'];
                $companyInformation->numeroDeInscripcionesIB = $data['numeroDeInscripcionesIB'];
                $companyInformation->cuentasGenerales = $data['cuentasGenerales'];
                $companyInformation->percepcionDeGanancia = $data['percepcionDeGanancia'];

                $companyInformation->save();

                return response()->json(['success' => 'Saved successfully'], 200);
        } 
    }

    public function updateCompanyInfo(Request $request){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
        if ($user && $this->IsGranted()) {
            $data = $request->all();

            $companyInformation = Companies::where('userId','=',$user->id)->first();
            if (count($companyInformation) > 0 ) {

                $companyInformation->name = $data['name'];
                $companyInformation->fantasyName = $data['fantasyName'];
                $companyInformation->sale_point = $data['sale_point'];
                $companyInformation->start_date = $data['start_date'];
                $companyInformation->email = $data['email'];
                $companyInformation->place = $data['place'];
                $companyInformation->codigoPostal = $data['codigoPostal'];
                $companyInformation->codigoProvincia = $data['codigoProvincia'];
                $companyInformation->address = $data['address'];
                $companyInformation->telephone = $data['telephone'];
                $companyInformation->cuit = $data['cuit'];
                $companyInformation->web = $data['web'];
                $companyInformation->iib = $data['iib'];
                $companyInformation->pib = $data['pib'];
                $companyInformation->epib = $data['epib'];
                $companyInformation->responsableInscripto = $data['responsableInscripto'];
                $companyInformation->excento = $data['excento'];
                $companyInformation->responsableMonotributo = $data['responsableMonotributo'];
                $companyInformation->ivaInscripto = $data['ivaInscripto'];
                $companyInformation->precioLista = $data['precioLista'];
                $companyInformation->condicionDeVenta = $data['condicionDeVenta'];
                $companyInformation->limiteDeCredito = $data['limiteDeCredito'];
                $companyInformation->numeroDeInscripcionesIB = $data['numeroDeInscripcionesIB'];
                $companyInformation->cuentasGenerales = $data['cuentasGenerales'];
                $companyInformation->percepcionDeGanancia = $data['percepcionDeGanancia'];

                $companyInformation->save();

                return response()->json(['success' => 'Saved successfully'], 200);
            } else {
                return response()->json(['error' => 'Client not Found'], 401);
            }
        }
    }

    public function deleteCompany(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
        if ($user && $this->IsGranted()) {
            $data = $request->all();
            Companies::where('id',$data['id'])->delete();

            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
