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
                $companyInformation->fantasyName = $data['fantasyName'];
                $companyInformation->email = $data['email'];
                $companyInformation->place = $data['place'];
                $companyInformation->codigoPostal = $data['codigoPostal'];
                $companyInformation->codigoProvincia = $data['codigoProvincia'];
                $companyInformation->address = $data['address'];
                $companyInformation->telephone = $data['telephone'];
                $companyInformation->tipoDocumento = $data['tipoDocumento'];
                $companyInformation->sale_point = $data['sale_point'];
                $companyInformation->documento = $data['documento'];
                $companyInformation->cuit = $data['cuit'];
                $companyInformation->web = $data['web'];
                $companyInformation->responsableInscripto = $data['responsableInscripto'];
                $companyInformation->excento = $data['excento'];
                $companyInformation->responsableMonotributo = $data['responsableMonotributo'];
                $companyInformation->cuentasGenerales = $data['cuentasGenerales'];

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
                $companyInformation->email = $data['email'];
                $companyInformation->place = $data['place'];
                $companyInformation->codigoPostal = $data['codigoPostal'];
                $companyInformation->codigoProvincia = $data['codigoProvincia'];
                $companyInformation->address = $data['address'];
                $companyInformation->telephone = $data['telephone'];
                $companyInformation->tipoDocumento = $data['tipoDocumento'];
                $companyInformation->sale_point = $data['sale_point'];
                $companyInformation->documento = $data['documento'];
                $companyInformation->cuit = $data['cuit'];
                $companyInformation->web = $data['web'];
                $companyInformation->responsableInscripto = $data['responsableInscripto'];
                $companyInformation->excento = $data['excento'];
                $companyInformation->responsableMonotributo = $data['responsableMonotributo'];
                $companyInformation->cuentasGenerales = $data['cuentasGenerales'];

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
