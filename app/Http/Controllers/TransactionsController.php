<?php

namespace App\Http\Controllers;
use App\User;
use Exception;
use App\Schedule;
use App\Master;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index()
    {
        $bill = Transaction::get();
        foreach ($bill as $data) {
            $data->image = asset('images/transaction/'. $data->image);
        }
        return apiResponse('200', 'success', 'list:', $bill);
    }

    public function show(){
        try {
        $bill = Transaction::where('status', 'Sudah Dibayar')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($bill as $data) {
            $data->image = asset('images/transaction/' . $data->image);
        }

        $latest = Transaction::where('status', 'Belum Dibayar')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        
        foreach ($latest as $data) {
            $data->image = asset('images/transaction/' . $data->image);
            }
            
        $data = [
            'history'   => count($bill) > 0 ? $bill : null,
            'latest'    => $latest
        ];
        
        return apiResponse('200', 'success', 'list:', $data);
        } catch (\Exception $e) {
            return apiResponse(404, 'error',' error', $e);
        }

    }

    
    public function destroy($id){
        try {
            Transaction::where('id',$id)->delete();
            return apiResponse(200,'success','Berhasil dihapus:');
        }catch (Exception $e) {
            return apiResponse(200,'error','error',$e);
        }
    }

    public function store(){
        try {
            $count = User::count();
            for ($i=1; $i<=$count; $i++) {
                Transaction::create([
                    'user_id' => $i,
                    'price' => request('price'),
                    'status' => request('status'),
                ]);    
            }
            $data = Transaction::get();
            
            return apiResponse( 200 , 'success', ' list :', $data); 
        } catch (Exception  $e) {
            return apiResponse(400,'error ', 'error', $e);
        }
    }

    public function payment(Request $request,$id)
    {
        try {
            if ($request->has('image')) {

                $extension = $request->file('image')->getClientOriginalExtension();

                $name = date('YmdHis') . '' . $id . '.' . $extension;

                $path = ('/home/pitrashm/public_html/images/transaction');

                $request->file('image')->move($path, $name);

                Transaction::where('id', $id)->update([
                    'image' => $name,
                    'status' => 'Sudah Dibayar'
                ]);
            }
            $update = Transaction::where('id', $id)->first();
            $update->image = asset('/images/transaction/' . $update->image);
            return apiResponse(202, 'success', 'user berhasil disunting', $update);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function update(Request $request,$id){
        try { 
        Transaction::where('id',$id)->update([
                    'status' => $request->status,
                ]); 
                $data = Transaction::where('id',$id)->first();
            return apiResponse(200,'success','berhasil  diedit',$data);
        }catch  (Exception $e) {
            return apiResponse(200,'error','error',$e);
        }
    }

}
