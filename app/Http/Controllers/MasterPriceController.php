<?php

namespace App\Http\Controllers;

use Exception;
use App\MasterPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterPriceController extends Controller
{
    public function index(){
        $master_price = MasterPrice::get();
        return apiResponse('200', 'success','list:',$master_price);
    }

    public function store(Request $request){
        try {

            $master_price = MasterPrice::create([
                'user_id' => auth()->user()->id,
                'price' => $request->price,
            ]); 
            return apiResponse(200, 'success','list :', $master_price);
        }
        
        catch(Exception $e) {
            return apiResponse(400, 'error', $e);
        }       
    }

    public function destroy($id){
        try {
                MasterPrice::where('id',$id)->delete();
            return apiResponse(200,'success','Berhasil dihapus:');
        }catch (Exception $e) {
            return apiResponse(400,'error','error',$e);
        }
    }

    public function update(Request $request, $id){
        try { 
                MasterPrice::where('id',$id)->update([
                    'user_id' => auth()->user()->id,
                    'price' => $request-> price,
                ]);
                $data = MasterPrice::where('id',$id)->first();
            return apiResponse(200,'success','berhasil  diedit',$data);
            }catch  (Exception $e) {
                return apiResponse(400,'error','error',$e);
            }
    }






}
