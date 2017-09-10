<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Categories;

class CategoriesController extends Controller
{
    public function getCategories() {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user){
           return Categories::where('company_id',$user->company_id)->get(); 
        }
    }

    public function saveCategories(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            $data = $request->all();
            try {    
                $category = new Categories();
                $category->company_id = $user->company_id;
                $category->category_name = $data['category_name'];
                $category->save();

            }  catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }

            return response()->json(['success' => 'Saved successfully'], 200);
        }
    }

    public function updateCategories(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {

            $data = $request->all();
            try {
                $category = Categories::where('id',$data['id'])->where('company_id',$user->company_id)->first();
                if (count($category) > 0) {
                    $category->company_id = $user->company_id;
                    $category->category_name = $data['category_name']; 
                    $category->save();
                }

                return response()->json(['success' => 'Updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 401);
            }
        }
    }

    public function deleteCategories(Request $request) {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user) {
            $data = $request->all();
            Categories::where('id',$data['id'])->delete();

            return response()->json(['success' => 'Deleted successfully'], 200);            
        }
    }
}
