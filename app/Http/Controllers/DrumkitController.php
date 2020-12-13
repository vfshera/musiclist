<?php

namespace App\Http\Controllers;

use App\Drumkit;
use App\Http\Resources\DrumkitsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DrumkitController extends Controller
{
    public function index()
    {
        $drumkits = Drumkit::orderBy('created_at', 'DESC')->paginate(8);

        return DrumkitsResource::collection($drumkits)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function getFrontKits()
    {
        $drumkits = Drumkit::orderBy('created_at', 'DESC')->paginate();

        return DrumkitsResource::collection($drumkits)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',
            'image'  => 'required|image|mimes:jpg,png,jpeg',
            'title' => 'required',
            'type' => 'required',
            'drumkit'  => 'required|mimes:zip',
            'sample'  => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ]);

        $drumkitImgFile =  $request->file('image');
        $drumkitImgFileName = time()."_"."DRUMKIT_IMG_".strtolower(str_replace(' ', '_',$drumkitImgFile->getClientOriginalName()));

        $DrumkitZipFile =  $request->file('drumkit');
        $randomName = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $dzipMidName = substr($randomName, 0, 10);
        $DrumkitZipFileName = "DZIP_".$dzipMidName."_".time().".zip";

        $DrumkitSampleFile =  $request->file('sample');
        $DrumkitSampleFileName = time()."_"."DRUMKIT_SAMPLE_".strtolower(str_replace(' ', '_',$DrumkitSampleFile->getClientOriginalName()));

        if( $drumkitImgFile->storeAs('public/drumkits/covers/', $drumkitImgFileName )  &&  $DrumkitSampleFile->storeAs('public/drumkits/samples/', $DrumkitSampleFileName )  && $DrumkitZipFile->storeAs('public/drumkits/zips/', $DrumkitZipFileName ) ){

//            $drumkit = new Drumkit();
//
//            $drumkit->about = $data['about'];
//            $drumkit->title = $data['title'];
            $data['drumkit'] = $DrumkitZipFileName;
            $data['sample'] = $DrumkitSampleFileName;
            $data['image'] =$drumkitImgFileName;
            Drumkit::create($data);
//
//            $drumkit->save();

            return response('Drumkit Created', Response::HTTP_CREATED);

        }else{
            return response('Can not Create Drumkit', Response::HTTP_FORBIDDEN);
        }

    }


    public function show(Drumkit $drumkit)
    {
        return (new DrumkitsResource($drumkit))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function update(Request $request, Drumkit $drumkit)
    {
        $data = $request->validate([
            'about' => 'required',
            'image'  => 'required|image|mimes:jpg,png,jpeg',
            'title' => 'required',
            'type' => 'required',
            'drumkit'  => 'required|mimes:zip',
            'sample'  => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ]);

        $drumkitImgFile =  $request->file('image');
        $drumkitImgFileName = time()."_"."DRUMKIT_IMG_".strtolower(str_replace(' ', '_',$drumkitImgFile->getClientOriginalName()));

        $DrumkitZipFile =  $request->file('drumkit');
        $randomName = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $dzipMidName = substr($randomName, 0, 10);
        $DrumkitZipFileName = "DZIP_".$dzipMidName."_".time().".zip";


        $DrumkitSampleFile =  $request->file('sample');
        $DrumkitSampleFileName = time()."_"."DRUMKIT_SAMPLE_".strtolower(str_replace(' ', '_',$DrumkitSampleFile->getClientOriginalName()));

        if( $drumkitImgFile->storeAs('public/drumkits/covers/', $drumkitImgFileName )  &&  $DrumkitSampleFile->storeAs('public/drumkits/samples/', $DrumkitSampleFileName )  && $DrumkitZipFile->storeAs('public/drumkits/zips/', $DrumkitZipFileName ) ){

            $drumImg = 'public/drumkits/covers/'.$drumkit->image;
            $drumSample = 'public/drumkits/samples/'.$drumkit->sample;
            $drumZip = 'public/drumkits/zips/'.$drumkit->drumkit;

            if(Storage::exists($drumImg) && Storage::exists($drumZip) && Storage::exists($drumSample) && Storage::delete([$drumImg,$drumZip,$drumSample])){

                $data['image'] = $drumkitImgFileName;
                $data['drumkit'] = $DrumkitZipFileName;
                $data['sample'] = $DrumkitSampleFileName;

                if($drumkit->update($data)){

                    return response('Drumkit Updated!', Response::HTTP_CREATED);

                }else{

                    return response('Can not Update Drumkit', Response::HTTP_FORBIDDEN);

                }

            }else{

                $replacerImgName = 'public/drumkits/covers/'.$drumkitImgFileName;
                $replacerZipName = 'public/drumkits/zips/'.$DrumkitZipFileName;
                $replacerSampleName = 'public/drumkits/samples/'.$DrumkitSampleFileName;
                Storage::delete([$replacerImgName,$replacerZipName,$replacerSampleName]);

                return response('Failed To Update Drumkit Image', Response::HTTP_FORBIDDEN);
            }

        }else{
            return response('Can not Update Drumkit', Response::HTTP_FORBIDDEN);
        }
    }

    public function download(Drumkit $drumkit){
        $pathToFile = 'public/drumkits/zips/'.$drumkit->drumkit;

        $headers = array(
            'Content-Type : application/octet-stream',
            'Content-Disposition : attachment; filename="'.$drumkit->title.'.zip"',
        );

        return Storage::download($pathToFile, $drumkit->title, $headers)->setStatusCode(Response::HTTP_OK);

    }



    public function destroy(Drumkit $drumkit)
    {
        $drumImg = 'public/drumkits/covers/'.$drumkit->image;
        $drumZip = 'public/drumkits/zips/'.$drumkit->drumkit;
        $drumSample = 'public/drumkits/samples/'.$drumkit->drumkit;

        if(Storage::exists($drumImg) && Storage::exists($drumZip) && Storage::exists($drumSample) && Storage::delete([$drumImg,$drumZip,$drumSample])){

            if($drumkit->delete()){
                return response('Drumkit Deleted', Response::HTTP_OK);
            }else{
                return response('Deleted Unable To Delete Drumkit', Response::HTTP_FORBIDDEN);
            }

        }else{
            return response('Not Found', Response::HTTP_FORBIDDEN);
        }

    }
}
