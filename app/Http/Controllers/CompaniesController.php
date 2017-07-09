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
        
        if ($user->role == UserRole::ADMIN) {
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
                $companyInformation->address = $data['address'];
                $companyInformation->telephone = $data['telephone'];
                $companyInformation->cuit = $data['cuit'];
                $companyInformation->web = $data['web'];
                $companyInformation->codigoPostal = $data['codigoPostal'];
                $companyInformation->iib = $data['iib'];
                $companyInformation->pib = $data['pib'];
                $companyInformation->epib = $data['epib'];
                $companyInformation->responsableInscripto = $data['codigoProvincia'];
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

        if ($user && $this->IsGranted()) {
            $data = $request->all();

            $companyInformation = Companies::where('userId','=',$user->id)->first();
            if (count($companyInformation) > 0 ) {

                $companyInformation->name = $data['name'];
                $companyInformation->fantasyName = $data['fantasyName'];
                $companyInformation->email = $data['email'];
                $companyInformation->place = $data['place'];
                $companyInformation->address = $data['address'];
                $companyInformation->telephone = $data['telephone'];
                $companyInformation->cuit = $data['cuit'];
                $companyInformation->web = $data['web'];
                $companyInformation->codigoPostal = $data['codigoPostal'];
                $companyInformation->iib = $data['iib'];
                $companyInformation->pib = $data['pib'];
                $companyInformation->epib = $data['epib'];
                $companyInformation->responsableInscripto = $data['codigoProvincia'];
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

        if ($user && $this->IsGranted()) {
            $data = $request->all();
            Companies::where('id',$data['id'])->delete();

            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
