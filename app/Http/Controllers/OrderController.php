<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Providers;
use App\Order;
use App\OrderDetail;
use App\Products;
use App\Movements;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Helpers\ApiResponse;
use DB;
use Auth; 

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
			$order->letter = $data['typeOfBuy'];
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

	public function getAllOrders() {
		$token = JWTAuth::getToken();         
		$user = JWTAuth::toUser($token);
	  if ($user) {
			$orders = Order::where('company_id',$user->company_id)->get(); 
			$orderInformation = [];
			foreach ($orders as $order) {
				$information['order'] = array('id' => $order->id, 'orderTotal' => $order->total, 'provider' => $order->provider_name, 'status' => $order->status, 'typeOfBuy' => $order->letter);
				$orderDetail = OrderDetail::where('order_id', $order->id)->get();
				$information['details'] = $orderDetail;
				$information['products'] = [];
				foreach ($orderDetail as $detail) {
					$product[$detail['product_id']] = Products::where('id', $detail['product_id'])->first();
				}					
				$information['products'] = $product;
				array_push($orderInformation, $information);
			}
			$r = new ApiResponse();
			$r->success = true;
			$r->message = 'Orden obtenida con exito';
			$r->code = 200;
			$r->data = $orderInformation;
	 
			return $r->doResponse();
		}

	}

	public function getOrderById(Request $request) {
		$token = JWTAuth::getToken();         
		$user = JWTAuth::toUser($token);
		$data = $request->all();   
		$order = Order::find($data['id']);

		$orderInformation['order'] = array('id' => $data['id'], 'orderTotal' => $order->subtotal, 'provider' => $order->provider_name,'status' => $order->status, 'typeOfBuy' => $order->letter);
		$orderInformation['details'] = OrderDetail::where('order_id',$data['id'])->get();

		$r = new ApiResponse();
		$r->success = true;
		$r->message = 'Orden obtenida con exito';
		$r->code = 200;
		$r->data = $orderInformation;

		return $r->doResponse();
	}

	// Necesitamos luego agregar restricciones a la hora de borrar una orden.
	// Luego cambiamos el hard delete por soft delete.
	public function deleteOrderById(Request $request) {
		if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
		$token = JWTAuth::getToken();
		$user = JWTAuth::toUser($token);
		$data = $request->all();   
		$orderDetail = OrderDetail::where('order_id',$data['id'])->delete();
		$order = Order::find($data['id'])->delete();

		$r = new ApiResponse();
		$r->success = true;
		$r->message = 'Orden borrada con exito';
		$r->code = 200;
		$r->data = $data['id'];

		return $r->doResponse();
	}

	public function completeOrder(Request $request) {

		$token = JWTAuth::getToken();
		$user = JWTAuth::toUser($token);		
		$order = Order::find($data['id']);
		$data = $request->all();   
		$order->status = 'R';

		$order->save();

		$items = OrderDetail::where('order_id', $data['id'])->get();
		foreach ($items as $it) {
			$movement =  new Movements();
			$movement->product_id = $it['product_id'];
			$movement->company_id = $user->company_id;
			$movement->order_id = $data['id'];
			$movement->quantity = $it['quantity'];
			$movement->type = 'in';
			$movement->price = $it['price'];
			$movement->tax = $it['tax'];
			$movement->save();
		}

		$r = new ApiResponse();
		$r->success = true;
		$r->message = 'Orden actualizada con exito';
		$r->code = 200;
		$r->data = $data['id'];

		return $r->doResponse();		
	}

}
