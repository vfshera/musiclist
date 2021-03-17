<?php

if(!function_exists('getRandomName')){
     function getRandomName(int $num){

        $nm = ($num && $num > 0) ? $num : 10;

        $randomName = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $finalname = substr($randomName, 0, $nm);

        return $finalname;
    }
}

