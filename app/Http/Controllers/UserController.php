<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\UserDetail;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $user = User::get();

        return apiResponse(200, 'success', 'List user', $user);
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                User::where('id', $id)->delete();
            });

            return apiResponse(202, 'success', 'user berhasil dihapus :(');
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->user_detail->image = $user->user_detail->imagePath;
            return apiResponse(200, 'success', '', $user);
        }

        return apiResponse(404, 'not found', 'User tidak ditemukan :(');
    }

    public function update(Request $request)
    {
        
        $this->id = Auth::user()->id;
        
         $rules = [
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address' => 'required',
        ];

        $message = [
            'name.required'     => 'Mohon isikan nama anda',
            'email.required'    => 'Mohon isikan email anda',
            'email.email'       => 'Mohon isikan email valid',
            'phone.required'    => 'Mohon isikan nomor hp anda',
            'address.required'           => 'Mohon isikan alamat',

        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        
            User::where('id', $this->id)->update([
                'name'  => $request->name,
                'email' => $request->email,
                //'password' => Hash::make($request->password),
                'phone'         => $request->phone,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            UserDetail::where('user_id', $this->id)->update([
                'address'       => $request->address,
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
            if ($request->has('image')) {
                $oldImage = Auth::user()->detail->image;

                if ($oldImage) {
                    $pleaseRemove = base_path('public/assets/images/user/') . $oldImage;

                    if (file_exists($pleaseRemove)) {
                        unlink($pleaseRemove);
                    }
                }

                $extension = $request->file('image')->getClientOriginalExtension();

                $name = date('YmdHis') . '' . $this->id . '.' . $extension;
                if(env('APP_ENV') == 'local') {
                $path = base_path('public/assets/images/user');
                } else {
                $path = '/home/pitrashm/public_html/images/user';
                }

                $request->file('image')->move($path, $name);

                UserDetail::where('user_id', $this->id)->update([
                    'image' => $name,
                ]);
            }
            $update = UserDetail::where('id',$this->id)->first();
                $update-> image = asset('images/user/' .$update->image);
                
            $user = User::where('id',$this->id)->first();


            $data = [
                'Data user' => $user,
                'Detail'        => $update
            ];
            return apiResponse(202, 'success', 'user berhasil disunting',$data);
    }
    
    public function changePassword(Request $request)
    {
         $rules = [
            
            'password'  => 'required|min:8',
            'confirm_password'     => 'required|same:password',
        ];

        $message = [
            'password.required' => 'Mohon isikan password anda',
            'password.min'      => 'Password wajib mengandung minimal 8 karakter',
            'confirm_password.same' => 'Samakan isi password anda',

        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        
        try {
            $this->id = Auth::user()->id;
            User::where('id', $this->id)->update([
                'password' => Hash::make($request->password),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return apiResponse(202, 'success', 'password berhasil disunting');
        }catch (Exception $e){
            return apiResponse (400, 'error', 'error', $e);
        }
    }

    
}
