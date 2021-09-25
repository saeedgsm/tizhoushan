<?php


namespace App\Helpers;


use Illuminate\Validation\Validator;
use Symfony\Component\Translation\TranslatorInterface;
use DB;
use Illuminate\Support\Facades\Input;
class CustomValidator extends Validator
{
    public function __construct(TranslatorInterface $translator, array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
    }

    protected function validateCustomValidator($attribute, $value, $parameters){
        return false;
    }

    protected function replaceCustomValidator($message, $attribute, $rule, $parameters){
        return str_replace(':other', $this->getAttribute($parameters[1]), $message);
    }

}
