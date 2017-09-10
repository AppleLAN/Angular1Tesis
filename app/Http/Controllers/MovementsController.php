<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Movements;

class MovementsController extends Controller
{
    public function getProductStock(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $data = $request->all();
        
        if ($user){
           $movements = Movements::where('company_id',$user->company_id)->where('product_id',$data['id'])->get(); 
           $total = 0;
           foreach($movements as $mov) {
                if ($mov['type'] == 'in') {
                    $total += $mov['quantity'];
                } else {
                    $total -= $mov['quantity'];
                }
           }
           return $total; 
        }
    }

    public function saveMovements(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            $data = $request->all();
            try {    
                $movement = new Movements();
                $movement->company_id = $user->company_id;
                $movement->product_id = $data['product_id'];
                $movement->order_id = $data['order_id'];
                $movement->sale_id = $data['sale_id'];
                $movement->quantity = $data['quantity'];
                $movement->type = $data['type'];

                $movement->save();
            }  catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }

            return response()->json(['success' => 'Saved successfully'], 200);
        }
    }

    public function updateMovements(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {

            $data = $request->all();
            try {
                $movement = Movements::where('id',$data['id'])->where('company_id',$user->company_id)->first();                
                if (count($movement > 0)){
                    $movement->company_id = $user->company_id;
                    $movement->product_id = $data['product_id'];
                    $movement->order_id = $data['order_id'];
                    $movement->sale_id = $data['sale_id'];
                    $movement->quantity = $data['quantity'];
                    $movement->type = $data['type'];
                    $movement->save();
                }

                return response()->json(['success' => 'Updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }
        }
    }

    public function deleteMovements(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            $data = $request->all();
            Movements::where('id',$data['id'])->delete();

            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
