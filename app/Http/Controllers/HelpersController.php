<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Clients;
use App\User;
use App\UserRoles;
use DB;
use Carbon\Carbon;

class HelpersController extends Controller
{
    public function getQuantity(Request $request) {
        $data = $request->all();
        /*$table,$typeOperation,$label*/
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user){
            if ($request['operation'] == 'cat') {
                $result = DB::table($data['table'])
                    ->select(DB::raw('count(id) as quantity'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
                    ->whereNull('deleted_at')
                    ->whereYear('created_at', '=', Carbon::now()->year)
                    ->groupby('year','month')
                    ->get();
            } else {
                $result =  DB::table($data['table'])
                    ->select(DB::raw('count(id) as quantity'), DB::raw('YEAR(deleted_at) as year, MONTH(deleted_at) as month'))
                    ->whereNotNull('deleted_at')
                    ->whereYear('deleted_at', '=', Carbon::now()->year)
                    ->groupby('year','month')
                    ->get();
            }

            $quantities = new \Illuminate\Database\Eloquent\Collection;
            for ($i=1;$i<=12;$i++) {
                $quantities->add(0);
            }

            foreach ($result as $res) {
                $quantities[$res->month] = $res->quantity;
            }

            $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            
            $resultData = new \Illuminate\Database\Eloquent\Collection;
            $resultData->add((object) ['data'=> $quantities, 'label' => $data['label']]);

            $response['result'] = $resultData;
            $response['months'] = $months;
                        
            return $response;
        }
    }

    public static function checkUserRole($id)
    {
        $role = UserRoles::where('user_id',$id)->first();

        return $role;
    }
}