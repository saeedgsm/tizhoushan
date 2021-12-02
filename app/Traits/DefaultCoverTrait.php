<?php


namespace App\Traits;


use App\DefaultCover;

trait DefaultCoverTrait
{
    public static function checkDefaultImage($image, $loc)
    {
        $defImage = $image;
        if ($image == null || !file_exists(public_path($image))) {
            $defCov = DefaultCover::query()->where('cover_loc',$loc)->first();
            if (!isset($defCov)) {
                $defImage = "imgs/404.png";
            }else {
                $defImage=$defCov->cover_url;
            }
        }
        return $defImage;
    }

}
