<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Resources\BlogsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{

    public function index()
    {
      $blogs = Blog::orderBy('created_at', 'DESC')->paginate(4);

      return BlogsResource::collection($blogs)->response()->setStatusCode(Response::HTTP_OK);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = $request->validate([
                        'content' => 'required',
                        'image'  => 'required|image',
                        'title' => 'required',
                        'type' => 'required',
                        'reflink'  => '',
                    ]);

        $blogImgFile =  $request->file('image');
        $blogImgFileName = time()."_"."BLOG_".strtolower(str_replace(' ', '_',$blogImgFile->getClientOriginalName()));

        if( $blogImgFile->storeAs('public/blogs', $blogImgFileName )  ){

            $blog = new Blog();

            $blog->content = $data['content'];
            $blog->title = $data['title'];
            $blog->type = $data['type'];
            $blog->reflink = ($data['reflink']) ? $data['reflink'] : '';
            $blog->image =$blogImgFileName;

            $blog->save();

            return response('Blog Created', Response::HTTP_CREATED);

        }else{
            return response('Can not Create Blog', Response::HTTP_FORBIDDEN);
        }

    }


    public function show(Blog $blog)
    {
      return (new BlogsResource($blog))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'content' => 'required',
            'image'  => 'required|image',
            'title' => 'required',
            'type' => 'required',
            'reflink'  => '',
        ]);

        $blogImgFile =  $request->file('image');
        $blogImgFileName = time()."_"."BLOG_".strtolower(str_replace(' ', '_',$blogImgFile->getClientOriginalName()));

        if( $blogImgFile->storeAs('public/blogs', $blogImgFileName )  ){
            $fullName = 'public/blogs/'.$blog->image;

           if(Storage::exists($fullName) && Storage::delete($fullName)){

               $data['image'] = $blogImgFileName;

               if($blog->update($data)){
                   return response('Blog Updated!', Response::HTTP_CREATED);
               }else{
                   return response('Can not Update Blog', Response::HTTP_FORBIDDEN);
               }

           }else{
               $replacerImgName = 'public/blogs/'.$blogImgFileName;
               Storage::delete($replacerImgName);
               return response('Failed To Update Blog Image', Response::HTTP_FORBIDDEN);
           }

        }else{
            return response('Can not Update Blog', Response::HTTP_FORBIDDEN);
        }
    }

    public function destroy(Blog $blog)
    {
        $fullName = 'public/blogs/'.$blog->image;

        if(Storage::exists($fullName) && Storage::delete($fullName)){
            if($blog->delete()){
                return response('Blog Deleted', Response::HTTP_OK);
            }else{
                return response('Deleted Unable To Delete Blog', Response::HTTP_FORBIDDEN);
            }
        }else{
            return response('Not Found', Response::HTTP_FORBIDDEN);
        }

    }
}
