<?php

namespace App\Http\Controllers;

use Exception;
use App\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosterController extends Controller
{
    public function index()
    {
        $poster = Poster::get();

        foreach($poster as $data){
            $data -> image = asset('/images/poster'. '/'. $data -> image) ;
        }

        return apiResponse(200, 'success', 'List Poster', $poster);
    }

    public function store(Request $request)
    {
        try {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            //$destination = base_path('public/images/poster');
            if (env('APP_ENV') == 'local') {
                    $path = base_path('public/images/poster');
                } else {
                    $path = '/home/pitrashm/public_html/images/poster';
                }
            $request->file('image')->move($path,$image);

                $id = Poster::insertGetId([
                    'user_id' => auth()->user()->id,
                    'image' => $image,
                    'created_at' => date ('Y-m-d H:i:s')
                ]);
            $update = Poster::where('id',$id)->first();
            $update->image = asset('/images/poster/' . $update->image);
            return apiResponse(201, 'success', 'berhasil ditambah',$update);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            DB::transaction(function () use ($request, $id) {
                
                if ($request->has('image')) {
                    $oldImage = Poster::where('id', $id)->first()->image;
    
                    if ($oldImage) {
                        $pleaseRemove = base_path('public/images/poster/') . $oldImage;
    
                        if (file_exists($pleaseRemove)) {
                            unlink($pleaseRemove);
                        }
                    }
    
                    $extension = $request->file('image')->getClientOriginalExtension();
    
                    $name = date('YmdHis') . '' . $id . '.' . $extension;
    
                    if(env('APP_ENV') == 'local') {
                    $path = base_path('public/assets/images/poster/');
                    } else {
                    $path = '/home/pitrashm/public_html/images/poster/';
                    }
    
                    $request->file('image')->move($path, $name);
    
                    Poster::where('id', $id)->update([
                        'user_id' => auth()->user()->id,
                        'image' => $name,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            });
            $update = Poster::where('id',$id)->first();
            $update -> image = asset('images/poster') . '/' .$update -> image;
            return apiResponse(202, 'success', 'user berhasil disunting',$update);
            
            // return apiResponse(202,'success', 'berhasil diedit');
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                Poster::where('id', $id)->delete();
            });

            return apiResponse(202, 'success', 'data berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
}
