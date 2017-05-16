<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Clients;

class ClientsController extends Controller
{
    public function getClients() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
           return Clients::where('user_id',$user->id)->get(); 
        }
    }

    public function saveClient(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {

            $data = $request->all();

            $client = new Clients();
            $client->name = $data['name'];
            $client->user_id = $user->id;
            $client->fantasyName = $data['fantasyName'];
            $client->email = $data['email'];
            $client->place = $data['place'];
            $client->address = $data['address'];
            $client->telephone = $data['telephone'];
            $client->cuit = $data['cuit'];
            $client->web = $data['web'];

            $client->save();

            return response()->json(['success' => 'Saved successfully'], 200);
        }
    }

    public function updateClient(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {

            $data = $request->all();
            try {
                $client = Clients::where('id',$data['id'])->where('user_id',$user->id)->first();
                $client->name = $data['name'];
                $client->fantasyName = $data['fantasyName'];
                $client->email = $data['email'];
                $client->place = $data['place'];
                $client->address = $data['address'];
                $client->telephone = $data['telephone'];
                $client->cuit = $data['cuit'];
                $client->web = $data['web'];

                $client->save();

                return response()->json(['success' => 'Updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Client not found'], 401);
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
