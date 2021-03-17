<?php

namespace App\Http\Controllers;

use App\Mail\NewsLetterMail;
use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{

    public function store(Request $request)
    {
        $validMailsub = $request->validate(['email' => 'required|email|unique:newsletters']);

        $sub =  [
            'email' => $validMailsub['email'],
            'nid' => getRandomName(14)
        ];

        if(Newsletter::create($sub)){

            Mail::to($sub['email'])->send(new NewsLetterMail($sub));
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
