<?php


namespace App\Traits;

use App\CustomField;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

trait OptionTrait
{
    use CustomFields;

    function convertNumbers($srting, $toPersian = true)
    {
        $en_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $fa_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        if ($toPersian) return str_replace($en_num, $fa_num, $srting);
        else return str_replace($fa_num, $en_num, $srting);
    }

    public function createUniquePrivateCode($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        do{
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check =User::where('private_code',$randomString)->get();

        }while(!$check->isEmpty());
        return $randomString;
    }

    public function createUniqueUserCode()
    {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        do{
            $randomString = '';
            for ($i = 0; $i < 6; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check =User::where('usercode',$randomString)->get();

        }while(!$check->isEmpty());
        return $randomString;
    }

    public function createUniqueProductCode()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        do{
            $randomString = '';
            for ($i = 0; $i < 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check = \App\Product::where('product_code',$randomString)->get();

        }while(!$check->isEmpty());
        return $randomString;
    }

    public function checkStudentInfo($user)
    {

        $user_fields = ['first_name','last_name','email','phone'];
        $student_fields = [
            'melli',
            'father',
            'state_id',
            'school_name',
            'tel_home',
            'tel_parent',
            'birthdate',
            'hamgam_code',];

        $cols=[];
        $custom = CustomField::query()->where('table_task', 'edit_student_info')->first();
        if (!empty($custom)) {
            $colsDef = $custom->field_list;
            $cols = $this->exportArray($colsDef);
            foreach ($user_fields as $user_field){
                if($cols[$user_field] == 1){
                    $checkVal = $user[$user_field] == null;
                    if ($checkVal == true){
                        return $checkVal;
                    }
                }
            }
            foreach ($student_fields as $student_field){
                if($cols[$student_field] == 1){
                    $checkVal = $user->student[$student_field] == null;
                    if ($checkVal == true){
                        return $checkVal;
                    }
                }
            }
            return false;
        }

      // if (!empty($cols))

    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
