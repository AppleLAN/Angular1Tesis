<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Movements;
use App\Companies;
use App\Sale;
use App\SaleDetail;
use App\Clients;
use App\Products;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Helpers\ApiResponse;
use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Response;
use App\Helpers\afipsdk\afipphp\src\Afip;

class SaleController extends Controller
{
	public function postSale(Request $request) {
		
		$token = JWTAuth::getToken();
		$user = JWTAuth::toUser($token);
		if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
			// Ignores notices and reports all other kinds... and warnings
			error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
			// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
		}
	    $data = $request->all();   

	    $sale = new Sale;

	    $sale->type = 'FC';
	    
	    $sale->company_id = $user->company_id;
	    $sale->warehouse_id = (isset($user->warehouse_id)) ? $user->warehouse_id : null;
	    $sale->user_id = $user->id;
	    $sale->status = "F";
	    
	    $company = Companies::find($user->company_id);
	    
	    
	    $sale->pos = (isset($data['pos'])) ? $data['pos'] : 0;
	    $sale->number = (isset($data['number'])) ? $data['number'] : 0;
	   
	    $client = Clients::find($data['client_id']);
	    if (count($client) > 0) {
	        $sale->client_id= $client['id'];
	        $sale->client_cuit= $client['cuit'];
	        $sale->client_address= $client['address'];
	        $sale->client_name= $client['name'];
	    } else {
	        $sale->client_id = $sale->client_cuit = $sale->client_address = $sale->client_name = null;
			}
			
			if ($company['responsableInscripto']  == 1) {
				if ($client['responsableInscripto'] == 1) {
					$sale->letter = 'A';
				} else {
					$sale->letter = 'B';
				}
			} else {
	    	$sale->letter = 'C';
			}

	    $sale->date = $data['saleDate'];

	    if (isset($data['saleDate'])) {
	      $sale->created_at = $data['saleDate'];
	    } else {
	      $sale->created_at = Carbon::now();
	    }

	    $sale->discount = isset($data['discount']) ?  $data['discount'] :0;

	    $sale->total = $data['total'];

	    $sale->payments = $data['paymentMethods']; 

	    $sale->notes = (isset($data['saleNote'])) ? $data['saleNote'] : 0;

			$sale->save();	

			$saleId = $sale->id;		
			
			try {
				foreach ($data['newStock'] as $newStock) {
					$itemDetail =  new SaleDetail();
					$itemDetail->product_id = $newStock['product']['id'];
					$itemDetail->sale_id = $saleId;
					$itemDetail->quantity = $newStock['quantity'];
					$itemDetail->price = $newStock['product']['cost_price'];
					$itemDetail->product_name = $newStock['product']['name'];
					$itemDetail->tax = 0;
					$itemDetail->save();
	
					$movement =  new Movements();
					$movement->product_id = $newStock['product']['id'];
					$movement->sale_id = $saleId;
					$movement->quantity = $newStock['quantity'];
					$movement->type = 'out';
					$movement->price = $newStock['product']['cost_price'];
					$movement->company_id = $user->company_id;
					$movement->tax = 0;
					$movement->save();
				}
			} catch (\Exception $e) {
				return response()->json(['Error' => 'Error: "'.$e->getMessage().'" guardando los productos'], 500);				
			}

	    $r = new ApiResponse();
	    $r->success = true;
	    $r->message = "Venta guardada exitosamente";
	    $r->code = 200;
	    $r->data = 'Success';

	    return $r->doResponse();
	}

	public function getSaleInfo(Request $request) {
		$token = JWTAuth::getToken();
		$user = JWTAuth::toUser($token);

		$id = $request->input('id');
		$saleInfo = [];

		if (!empty($id)) {
			$sale['sale'] = Sale::find($id);
			$sale['sale_details'] = SaleDetail::where('sale_id', $id)->get();
			$sale['products'] = [];
			foreach ($sale['sale_details'] as $detail) {
				$product[$detail['product_id']] = Products::where('id', $detail['product_id'])->first();
			}	
			$sale['products'] = $product;
			array_unshift($saleInfo, $sale);
		} else {
			$sales = Sale::where('company_id',$user->company_id)->get(); 			

			foreach ($sales as $s) {
				$sale['sale'] = $s;
				$sale['sale_details'] = SaleDetail::where('sale_id', $s->id)->get();
				$sale['products'] = [];
				foreach ($sale['sale_details'] as $detail) {
					$product[$detail['product_id']] = Products::where('id', $detail['product_id'])->first();
				}	
				$sale['products'] = $product;
				array_unshift($saleInfo, $sale);				
			}
		}

		$r = new ApiResponse();
	    $r->success = true;
	    $r->message = "Informacion cargada exitosamente";
	    $r->code = 200;
	    $r->data = $saleInfo;

	    return $r->doResponse();
	}

	public function getAfipCae(Request $request){
		$afip = new Afip(array('CUIT' => '20366017314','cert' => 'certifkey/cert/certificate.pem', 'key' => 'certifkey/cert/privada.key', 'passphrase' => 'liratkm'));
		$token = JWTAuth::getToken();
		$user = JWTAuth::toUser($token);

		# Check server status
		$server_status = $afip->ElectronicBilling->GetServerStatus();
		$appServer = $server_status->AppServer === 'OK'?1:0;
		$dbServer = $server_status->DbServer === 'OK'?1:0;
		$authServer = $server_status->AuthServer === 'OK'?1:0;

		if (!$appServer) {
			return response()->json(['error' => 'Error from AFIP APP Server'], 500);
		}

		if (!$dbServer){
			return response()->json(['error' => 'Error from AFIP DB Server'], 500);
		}

		if (!$authServer){
			return response()->json(['error' => 'Error from AFIP AUTH Server'], 500);
		}

		$sale = Sale::find($request->input('saleId'));
		$userC = Companies::where('id','=',$user->company_id)->first();

		try {
			if (!empty($sale->cae_data) && isset(json_decode($sale->cae_data)->CAE)) {
				return response()->json(['success' => json_decode($sale->cae_data)], 200);
			} else{
				try {
					if ($request->isMethod('post')) {
						if($sale->letter == 'A') {
							$CbteTipo = 63;
						} else if ($sale->letter == 'B') {
							$CbteTipo = 61;
						} else {
							$CbteTipo = 15;
						}
						// convierte MM/DD/YYYY en YYYY/MM/DD
						$CbteFch = Carbon::parse($sale->created_at)->format('Ymd');
						//Devuelve el número del último comprobante creado para el punto de venta y el tipo de comprobante
						$last_voucher = $afip->ElectronicBilling->GetLastVoucher($userC->sale_point,$CbteTipo);
						$valfac = $last_voucher + 1;
						// 23000000000 no categorizado para que ignore la busqueda en padron;
						$data = array(
							'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
							'PtoVta' 	=> $userC->sale_point,  // Punto de venta
							'CbteTipo' 	=> $CbteTipo,  // Tipo de comprobante (ver tipos disponibles) 
							'Concepto' 	=> 1,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
							'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
							'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
							'CbteDesde' 	=> $valfac,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
							'CbteHasta' 	=> $valfac,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
							'CbteFch' 	=> $CbteFch, // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
							'ImpTotal' 	=> $sale->total, // Importe total del comprobante
							'ImpTotConc' 	=> $sale->total,   // Importe neto no gravado
							'ImpNeto' 	=> 0, // Importe neto gravado
							'ImpOpEx' 	=> 0,   // Importe exento de IVA
							'ImpIVA' 	=> 0,  //Importe total de IVA
							'ImpTrib' 	=> 0,   //Importe total de tributos
							'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
							'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
						);
						$cae = $afip->ElectronicBilling->CreateVoucher($data);
					
						$sale->cae_data = json_encode($cae);
						$sale->save();			
						return response()->json(['success' => $cae], 200);
					}
				} catch (\Exception $e) {
					return response()->json(['error' => $e->getMessage()], 500);
				}
			}
		} catch (\Exception $e) {
				return response()->json(['error' => $e->getMessage()], 500);
		}
	}
}

