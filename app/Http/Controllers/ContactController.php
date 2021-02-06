<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactForwardEmail;
use App\Mail\ContactReceivedEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $contact = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

       if(Contact::create($contact)){

           Mail::to($contact['email'])->send(new ContactReceivedEmail($contact['name']));
           Mail::to(env('SUPPORT_MAIL_ADDRESS'))->send(new ContactForwardEmail(json_decode(json_encode($contact))));

           return response($contact['name'].' Your Message Was Sent!', Response::HTTP_CREATED);

       }else{
           return response('Can not Message Admin', Response::HTTP_FORBIDDEN);
       }

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
