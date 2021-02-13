<?php

namespace App\Http\Controllers;

use App\Price;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceController extends Controller
{

    public function index()
    {
        $prices = Price::all();
        return response( $prices , Response::HTTP_OK);
    }


    public function primary()
    {
        $price = Price::where('code', 'BSC')->get();

        return response($price , Response::HTTP_OK);
    }


    public function update(Request $request, Price $price)
    {
        $nprice = $request->validate([
                'amount'=> 'required'
            ]);

           if( $price->update($nprice)){
               return response('License Updated!', Response::HTTP_OK);
           }else{
               return response('Can not Update License', Response::HTTP_FORBIDDEN);
           }
    }

}
