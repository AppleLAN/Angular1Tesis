<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Providers;
use App\Order;
use App\OrderDetail;
use App\Products;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use DB;

class OrderController extends Controller
{
    public function postOrder(Request $request) {
	
	    $data = $request->all();   
	    DB::beginTransaction();

			$token = JWTAuth::getToken();         
			$user = JWTAuth::toUser($token);

	  	$providerInfo = Providers::where('id',$data['provider_id'])->where('company_id', $user->company_id)->first();
	    # Save Order
	    $order = new Order;
	    $order->provider_id = $providerInfo->id;
	    $order->user_id = $user->id;
	    $order->status = "C";
	    $order->provider_name = $providerInfo->name;
	    $order->provider_cuit = $providerInfo->cuit;
	    $order->provider_address = $providerInfo->address;
	    $order->subtotal = $data['total']; 
	    $order->discount = 0; #
	    $order->taxes = 0; # Tenemos que agregar lo del impuesto luego
	    $order->total = $data['total'];
	    $order->company_id = $user->company_id;
			$order->save();
			$orderId = $order->id;
	    DB::commit();

	    # Save products of order into order detail
	    try {
	    	foreach ($data['newStock'] as $newStock) {
	   			$orderDetail = new OrderDetail();
					$orderDetail->order_id = $orderId; 
	   			$orderDetail->product_id = $newStock['product']['id'];
					$orderDetail->product_name = $newStock['product']['name'];
	   			$orderDetail->quantity = $newStock['quantity'];
	   			$orderDetail->price = $newStock['product']['cost_price'];
	   			$orderDetail->tax = 0; #
	   			$orderDetail->save();
	    	}
	    } catch (\Exception $e) {
				return response()->json(['Error' => 'Error: "'.$e->getMessage().'" guardando los productos'], 500);				
	    }

			return response()->json(['Success' => 'Compra guardada exitosamente'], 200);				
	}
}
