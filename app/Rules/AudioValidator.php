<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AudioValidator implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        if(!empty($value->getClientOriginalExtension()) && $value->getClientOriginalExtension() == 'mp3') {
                return true;
        }else{
                return false;
        }
    }


    public function message()
    {
        return 'The Audio Sample Must Be an Mp3';
    }
}
