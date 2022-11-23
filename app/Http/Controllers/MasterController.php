<?php

namespace App\Http\Controllers;

use Exception;
use App\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class MasterController extends Controller
{
    public function index(){
        $master = Master::get();
        return apiResponse('200', 'success','list:',$master);
    }

    // public function show($id){
    //     $id = Master::where('id', $id)->first();
    //     return apiResponse(200,'success','list',$id);
    // }

    public function store(Request $request){
        try {

            $master = Master::create([
                'user_id' => auth()->user()->id,
                'day' => Carbon::create($request->day),
            ]);
            $master->day = date('D-m-Y',strtotime($master->day));
            return apiResponse(200, 'success','list :', $master);
        }
        
        catch(Exception $e) {
            return apiResponse(400, 'error', $e);
        }
        
    }

    public function destroy($id){
        try {
            
                Master::where('id',$id)->delete();
            return apiResponse(200,'success','Berhasil dihapus:');
        }catch (Exception $e) {
            return apiResponse(200,'error','error',$e);
        }
    }

    public function update(Request $request, $id){
        //dd($id);
        try { 
                 Master::where('id',$id)->update([
                    'user_id' => auth()->user()->id,
                    'day' => $request->day,
                ]);
                $data = Master::where('id',$id)->first();
            return apiResponse(200,'success','berhasil  diedit',$data);
            }catch  (Exception $e) {
                return apiResponse(200,'error','error',$e);
            }
    }

    
}
