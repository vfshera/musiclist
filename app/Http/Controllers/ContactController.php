<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
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
