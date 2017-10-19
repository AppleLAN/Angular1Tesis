<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Products;
use App\Providers;
class ProductsController extends Controller
{
    public function getProducts() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
           return Products::where('company_id',$user->company_id)->get(); 
        }
    }

    public function saveProducts(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            try {
                $data = $request->all();
                
                $product = new Products();
                $product->company_id = $user->company_id;
                $product->provider_id = $data['provider_id'];
                $product->name = $data['name'];
                $product->code = $data['code'];
                $product->description = $data['description'];
                $product->cost_price = $data['cost_price'];
                $product->sale_price = $data['sale_price'];
                $product->category_id = $data['category_id']; 

                $product->save();
            }  catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }

            return response()->json(['success' => 'Saved successfully'], 200);
        }
    }

    public function updateProducts(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {

            $data = $request->all();
            try {
                
                $product = Products::where('id',$data['id'])->where('company_id',$user->company_id)->first();                
                if (count($product) > 0) {    
                    $product->company_id = $user->company_id;
                    $product->company_id = $data['provider_id'];
                    $product->name = $data['name'];
                    $product->code = $data['code'];
                    $product->description = $data['description'];
                    $product->cost_price = $data['cost_price'];
                    $product->sale_price = $data['sale_price'];
                    $product->category_id = $data['category_id']; 
                }

                $product->save();

                return response()->json(['success' => 'Updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }
        }
    }

    public function deleteProducts(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            $data = $request->all();
            Products::where('id',$data['id'])->delete();

            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
