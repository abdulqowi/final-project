<?php

namespace App\Http\Controllers;


use Exception;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    public function index()
    {
        $data = Schedule::get();
        foreach ($data as $data) {
            $data->Due_Date = Carbon::create($data->Due_Date)->toFormattedDayDateString();
            $data->Begin_Date = Carbon::create($data->Begin_Date)->toFormattedDayDateString();
        }
                return apiResponse('200', 'success', 'list:', $data);
    }
    
    public function store(Request $request)
    {
        try {
            $id = Schedule::insertGetId([
                'user_id' => request('user_id'),
                'Begin_Date' => Carbon::create($request->Begin_Date),
                'Due_Date' => Carbon::create($request->Due_Date),
                'Category' => request('Category'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $data = Schedule::where('id', $id)->first();
            $data->Begin_Date = Carbon::create($data->Begin_Date)->toFormattedDayDateString();            
            $data->Due_Date = Carbon::create($data->Due_Date)->toFormattedDayDateString();
            return apiResponse(200, 'success', 'list :', $data);
        } catch (Exception $e) {
            return apiResponse(400, 'error', $e);
        }
    }


    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                Schedule::where('id', $id)->delete();
            });
            return apiResponse(200, 'success', 'Berhasil dihapus:');
        } catch (Exception $e) {
            return apiResponse(200, 'error', 'error', $e);
        }
    }
    
     public function show ($id) {
        try {
            $data = Schedule::findOrFail($id);
            return apiResponse(200, 'success', ' list :', $data);
        }catch (Exception $e) {
            return apiResponse(404, 'error', 'not found', $e);
        }
    }
    
    public function payment()
    {
            $history = Schedule::where('Begin_Date', '<', Carbon::now())->where('Category','=', 'Pembayaran')
        ->orderBy('created_at', 'desc')
        ->get();
        
         foreach ($history as $data) {
                $data->Due_Date = Carbon::create($data->Due_Date)->toFormattedDayDateString();
                $data->Begin_Date = Carbon::create($data->Begin_Date)->toFormattedDayDateString();
            }
    
        $incoming = Schedule::where('Begin_Date', '>', Carbon::now())->where('Category','=', 'Pembayaran')
        ->orderBy('created_at', 'desc')
        ->get();
        
        foreach ($incoming as $data) {
            $data->Due_Date = Carbon::create($data->Due_Date)->toFormattedDayDateString();
            $data->Begin_Date = Carbon::create($data->Begin_Date)->toFormattedDayDateString();
        }
        
        $data = [
            'history' => $history,
            
            'incoming' => $incoming,
        ];
        
        // $schedule ->day = Master::where('id',) .$schedule->day; 
        return apiResponse('200', 'success', 'list:', $data);
    }
    
    public function pickup ()
    {
            $history = Schedule::where('Begin_Date', '<', Carbon::now())->where('Category','=', 'Pickup')
        ->orderBy('created_at', 'desc')
        ->get();
        
         foreach ($history as $data) {
                $data->Due_Date = Carbon::create($data->Due_Date)->toFormattedDayDateString();
                $data->Begin_Date = Carbon::create($data->Begin_Date)->toFormattedDayDateString();
            }
    
        $incoming = Schedule::where('Begin_Date', '>', Carbon::now())->where('Category','=', 'Pickup')
        ->orderBy('created_at', 'desc')
        ->get();
        
        foreach ($incoming as $data) {
            $data->Due_Date = Carbon::create($data->Due_Date)->toFormattedDayDateString();
            $data->Begin_Date = Carbon::create($data->Begin_Date)->toFormattedDayDateString();
        }
        
        $data = [
            'history' => $history,
            
            'incoming' => $incoming,
        ];
        
        // $schedule ->day = Master::where('id',) .$schedule->day; 
        return apiResponse('200', 'success', 'list:', $data);
    }
    
}