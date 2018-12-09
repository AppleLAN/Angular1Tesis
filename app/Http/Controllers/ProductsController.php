<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Products;
use App\Providers;
use App\Movements;
use Carbon\Carbon;
use DB;

class ProductsController extends Controller
{
    public function getProducts() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){

           $products = Products::where('company_id',$user->company_id)->whereNull('deleted_at')->get();
           foreach ($products as $p) {
               $movements = Movements::where('company_id',$user->company_id)->where('product_id',$p->id)->get(); 
               $total = 0;
               foreach($movements as $mov) {
                       if ($mov['type'] == 'in') {
                           $total += $mov['quantity'];
                       } else {
                           $total -= $mov['quantity'];
                       }
               }
               $p->stock = $total;
           }
           return $products;
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
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
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
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
        if ($user) {
            $data = $request->all();
            $product = DB::table('products')->where('id', $data['id'])->update(['deleted_at' => Carbon::now()]);
            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
