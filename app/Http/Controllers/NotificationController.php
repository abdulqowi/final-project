<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
        $notif = Notification::get();
        return apiResponse(200, '   success','  list   ',$notif);
        } catch (Exception $e) {
            return apiResponse (404 ,'error', 'error', $e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store()
    {
        try { 
            $data =Notification::create([
                'notification' => request('notification'), 
                'Category' => request('Category'),
                'Time' => Carbon::now()->toDayDateTimeString(),
            ]);
            return apiResponse(201 , 'success', 'success',$data);
        }catch ( Exception $e) {
            return apiResponse(404,' error', ' error '  , $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {  
            $notif = Notification::find($id);
            // $notif['Time'] = date('D-m-Y H:i:s',strtotime($notif['Time']));
            return apiResponse(200,'success', ' list ',$notif);
        }catch (Exception $e){
            return apiResponse(404,'error ', 'Not Found', $e);
        }
    }

    public function update($id)
    {
        try { 
            Notification::where('id', $id)->update([
                'notification' => request('notification'), 
                'Category' => request('Category'),
                'Time' => Carbon::now()->toDayDateTimeString(),
            ]);
            $data = Notification ::where('id',$id)->first();
            return apiResponse(201 , 'success', 'Updated ', $data); 
        }catch (Exception $e){
            return apiResponse(404,'error ', 'Not Found', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Notification::where('id',$id) -> delete(); 
            return apiResponse(200,' success ', 'Berhasil dihapus:');
        }catch (Exception $e) {
            return apiResponse(401,'error', 'error',$e);
        }
    }

    public function send($id)
    {
        try { 
            Notification::where('id', $id)->update([
                'isRead' => '1',
                'Category' => request('Category'),
                
            ]);
            $data = Notification::where('id',$id)->first();
            return apiResponse(201 , 'success', 'Updated ', $data); 
        }catch (Exception $e){
            return apiResponse(404,'error ', 'Not Found', $e);
        }
    }
}
