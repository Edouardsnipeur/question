<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Http\File;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
//use Symfony\Component\HttpFoundation\File\File;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function resizePlaylistImage($folderRoute,$image,$slug)
    {
        //symlink(storage_path('app/public'), public_path('storage'));
        $imageName=false;
        if (isset($image)){
            //determination d'un nom unique pour l'image
            $curentdate=Carbon::now()->toDateString();
            $imageName=$slug.'-'.$curentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //creation du dossier post si il n'existe pas

            if (!Storage::disk('public')->exists($folderRoute)){
                Storage::disk('public')->makeDirectory($folderRoute);
            }

            //redimensionner et uploader l'image
            $categoryName=Image::make($image)->resize(256, 256)->save($imageName);
            //$img->save(true);
            if (Storage::disk('pub')->exists($imageName)){
                $full_path_source = Storage::disk('pub')->getDriver()->getAdapter()->applyPathPrefix($imageName);
                $full_path_dest = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($imageName);
                File::move($full_path_source, $full_path_dest);
            }
            Storage::disk('public')->put($folderRoute.'/'.$imageName,$categoryName);

        }
        return $imageName;
    }
    public static function DeleteTemp($name){
        if (Storage::disk('pub')->exists($name)){
            Storage::disk('pub')->delete($name);
        }
    }
    public static function DeleteUpdate($name){
        if (Storage::disk('public')->exists('playlist/image/'.$name)){
            Storage::disk('public')->delete('playlist/image/'.$name);
        }
    }
}
