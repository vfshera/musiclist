<?php

namespace App\Http\Controllers;

use App\Mail\NewsLetterMail;
use App\Newsletter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{

    public function store(Request $request)
    {
        $sub = $request->validate(['email' =>'require|email|unique:newsletters']);

        if(Newsletter::create($sub)){

            Mail::to($sub['email'])->send(new NewsLetterMail());
            return response('You Are Now Subscribed!', Response::HTTP_CREATED);

        }else{
            return response('Unable To Subscribe!', Response::HTTP_FORBIDDEN);
        }
    }


    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
