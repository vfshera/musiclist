<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Resources\GalleryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class GalleryController extends Controller
{
    public function index()
    {
        $imgs = Gallery::orderBy('created_at', 'DESC')->paginate(8);

        return GalleryResource::collection($imgs)->response()->setStatusCode(Response::HTTP_OK);
    }


    public function store(Request $request)
    {
       $request->validate(['image' => 'required|image']);

        $galImg =  $request->file('image');
        $galImgFileName  = getRandomName(10).time().'.'.$galImg->getClientOriginalExtension();

        if($galImg->storeAs('public/gallery', $galImgFileName ) ){
            $gmig = new Gallery();
            $gmig->image = $galImgFileName;

            if($gmig->save()){
                return response('Image Added To Gallery!', Response::HTTP_CREATED);

            }else{
                return response('Failed To Upload Image!', Response::HTTP_FORBIDDEN);
            }
        }else{
            return response('Failed To Save Image!', Response::HTTP_FORBIDDEN);
        }
    }



    public function destroy(Gallery $gallery)
    {
        $gimgUrl = 'public/gallery/'.$gallery->image;

        if(Storage::exists($gimgUrl)  && Storage::delete($gimgUrl)){

            if($gallery->delete()){
                return response('Image Deleted From Gallery!', Response::HTTP_OK);
            }else{
                return response('Unable To Delete Image!', Response::HTTP_FORBIDDEN);
            }

        }else{
            return response('Image Not Found!', Response::HTTP_FORBIDDEN);
        }
    }
}
