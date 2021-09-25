<?php


namespace App\Traits;


use App\RegistrationFee;

trait RegistrationFeeTrait
{
    public function checkRegistrationFee()
    {
        $reg = RegistrationFee::query()->first();
        if ($reg->status === 1){
            return true;
        }else{
            return false;
        }
    }
}