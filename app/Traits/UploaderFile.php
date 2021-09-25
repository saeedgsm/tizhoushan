<?php


namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Str;

trait UploaderFile
{
    // upload image
    public function uploadImage($file, $type)
    {
        $mimeTypes=['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        if(in_array($file, $mimeTypes) ){
            list($width, $height) = getimagesize($file);
            $name = Str::random(8). '_' . $width . 'x' . $height . '.' .$file->getClientOriginalExtension();
        }else{
           // $file->getClientOriginalName
            $name = Str::random(8). '.' .$file->getClientOriginalExtension();
        }
        $url = 'upload/'. $type . '/'. $year . '_' . $month .'/';
        $file->move($url,$name);
        return $url . $name;
    }

    public function UploadSoalFiles($file, $folder)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;

        $filename = Carbon::now()->timestamp. '.' .$file->getClientOriginalExtension();
        $dir = 'upload/'. $folder . '/'. $year . '/' . $month .'/'. $day .'/';
        $file->move(public_path($dir),$filename);
        return $dir . $filename;
    }

}
