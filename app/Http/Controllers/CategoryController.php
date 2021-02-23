<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function index()
    {
        return Category::orderBy('created_at', 'DESC')->get(['id' , 'name']);
    }


    public function store(Request $request)
    {
        $cat = $request->validate([
            'name' => 'required'
        ]);

        if(Category::create($cat)){

            return response('Category Created!', Response::HTTP_CREATED);

        }else{

            return response('Can Create Category!', Response::HTTP_FORBIDDEN);

        }
    }



    public function destroy(Category $category)
    {
        if($category->delete()){

            return response('Category Deleted!', Response::HTTP_OK);

        }else{

            return response('Can Delete Category!', Response::HTTP_FORBIDDEN);

        }
    }
}
