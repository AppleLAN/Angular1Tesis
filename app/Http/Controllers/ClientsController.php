<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Clients;
use App\User;
use App\Companies;
use App\Enums\UserRole;
use Hash;

class ClientsController extends Controller
{
    public function getClients() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
           return Clients::where('company_id',$user->company_id)->get(); 
        }
    }

    public function getProfileData() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user) {
            $role = HelpersController::checkUserRole($user->id);
            if ($user && $role->role_id == UserRole::ADMIN) {
      
                $clients = Clients::select('id','company_id','created_at','updated_at','deleted_at',
                'name','fantasyName','email','place','codigoPostal','codigoProvincia','address','telephone','cuit',
                'web','iib','pib','epib','responsableInscripto','excento','responsableMonotributo','ivaInscripto','precioLista',
                'condicionDeVenta','limiteDeCredito','numeroDeInscripcionesIB','cuentasGenerales','percepcionDeGanancia') 
                        ->where('company_id',$user->company_id) 
                        ->first(); 
                $response['company'] = $clients;
            }
            
            $users = User::select('username','company_id','name','lastname','email','birthday','address','sales','providers','stock','clients') 
                         ->where('id',$user->id) 
                         ->first(); 
            $response['profile'] = $users;

            return $response;
        }
    }

    public function updateUserProfile(Request $request){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        
        if ($user) {
            $data = $request->all();
            // Search for user personal Data
            $userI = User::where('id','=',$user->id)->first();
            $userI->username = $data['username'];
            $userI->lastname = $data['lastname'];
            $userI->email = $data['email'];
            if(isset($data['newPassword']) || isset($data['password']))
                $userI->password = isset($data['newPassword']) ?  Hash::make( $data['newPassword'] ): Hash::make( $data['password'] );
            $userI->birthday = $data['birthday'];
            $userI->address = $data['address'];
            
            if ($user->role == UserRole::ADMIN) {
                $userI->sales = $data['sales'];
                $userI->stock = $data['stock'];
                $userI->clients = $data['clients'];
                $userI->providers = $data['providers'];
            }

            $userI->save();
            return response()->json(['success' => 'Saved successfully'], 200);            
        }
    }

    public function updateUserCompany(Request $request){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $role = HelpersController::checkUserRole($user->id);

        if ($user && $role->role_id == UserRole::ADMIN) {
            $data = $request->all();

            // Search for user's company Data
            if ($data['type'] == 'CREATE') {
                $userC = new Companies();
            } else {
                $userC = Clients::where('company_id','=',$user->company_id)->first();
            }
            $userC->name = $data['name'];
            $userC->fantasyName = $data['fantasyName'];
            $userC->email = $data['email'];
            $userC->place = $data['place'];
            $userC->address = $data['address'];
            $userC->telephone = $data['telephone'];
            $userC->cuit = $data['cuit'];
            $userC->web = $data['web'];
            $userC->codigoPostal = $data['codigoPostal'];
            $userC->iib = $data['iib'];
            $userC->pib = $data['pib'];
            $userC->epib = $data['epib'];
            $userC->responsableInscripto = $data['codigoProvincia'];
            $userC->excento = $data['excento'];
            $userC->responsableMonotributo = $data['responsableMonotributo'];
            $userC->ivaInscripto = $data['ivaInscripto'];
            $userC->precioLista = $data['precioLista'];
            $userC->condicionDeVenta = $data['condicionDeVenta'];
            $userC->limiteDeCredito = $data['limiteDeCredito'];
            $userC->numeroDeInscripcionesIB = $data['numeroDeInscripcionesIB'];
            $userC->cuentasGenerales = $data['cuentasGenerales'];
            $userC->percepcionDeGanancia = $data['percepcionDeGanancia'];
            $userC->save();  

            $userData = User::find($user->id);
            $userData->company_id = $userC->id;
            $userData->save();
            return response()->json(['success' => 'Saved successfully'], 200);
        } else {
            return response()->json(['error' => 'Permissions Error'], 401);            
        }
    }

    public function saveClient(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            try {
                $data = $request->all();
                $client = new Clients();
                $client->name = $data['name'];
                $client->company_id = $user->company_id;
                $client->fantasyName = $data['fantasyName'];
                $client->email = $data['email'];
                $client->place = $data['place'];
                $client->address = $data['address'];
                $client->telephone = $data['telephone'];
                $client->cuit = $data['cuit'];
                $client->web = $data['web'];
                $client->codigoPostal = $data['codigoPostal'];
                $client->iib = $data['iib'];
                $client->pib = $data['pib'];
                $client->epib = $data['epib'];
                $client->responsableInscripto = $data['codigoProvincia'];
                $client->excento = $data['excento'];
                $client->responsableMonotributo = $data['responsableMonotributo'];
                $client->ivaInscripto = $data['ivaInscripto'];
                $client->precioLista = $data['precioLista'];
                $client->condicionDeVenta = $data['condicionDeVenta'];
                $client->limiteDeCredito = $data['limiteDeCredito'];
                $client->numeroDeInscripcionesIB = $data['numeroDeInscripcionesIB'];
                $client->cuentasGenerales = $data['cuentasGenerales'];
                $client->percepcionDeGanancia = $data['percepcionDeGanancia'];            

                $client->save();
            }  catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }

            return response()->json(['success' => 'Saved successfully'], 200);
        }
    }

    public function updateClient(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {

            $data = $request->all();
            try {
                $client = Clients::where('id',$data['id'])->where('company_id',$user->company_id)->first();
                    $client->name = $data['name'];
                    $client->company_id = $user->company_id;                
                    $client->fantasyName = $data['fantasyName'];
                    $client->email = $data['email'];
                    $client->place = $data['place'];
                    $client->codigoPostal = $data['codigoPostal'];
                    $client->codigoProvincia = $data['codigoProvincia'];
                    $client->address = $data['address'];
                    $client->telephone = $data['telephone'];
                    $client->cuit = $data['cuit'];
                    $client->web = $data['web'];
                    $client->codigoPostal = $data['codigoPostal'];
                    $client->iib = $data['iib'];
                    $client->pib = $data['pib'];
                    $client->epib = $data['epib'];
                    $client->responsableInscripto = $data['codigoProvincia'];
                    $client->excento = $data['excento'];
                    $client->responsableMonotributo = $data['responsableMonotributo'];
                    $client->ivaInscripto = $data['ivaInscripto'];
                    $client->precioLista = $data['precioLista'];
                    $client->condicionDeVenta = $data['condicionDeVenta'];
                    $client->limiteDeCredito = $data['limiteDeCredito'];
                    $client->numeroDeInscripcionesIB = $data['numeroDeInscripcionesIB'];
                    $client->cuentasGenerales = $data['cuentasGenerales'];
                    $client->percepcionDeGanancia = $data['percepcionDeGanancia'];            

                $client->save();

                return response()->json(['success' => 'Updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }
        }
    }

    public function deleteClient(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            $data = $request->all();
            Clients::where('id',$data['id'])->delete();

            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
