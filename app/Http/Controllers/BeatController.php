<?php

namespace App\Http\Controllers;

use App\Beat;
use App\Http\Resources\BeatsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BeatController extends Controller
{
    public function index()
    {
        $beats = Beat::orderBy('created_at', 'DESC')->paginate(8);

        return BeatsResource::collection($beats)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function getFrontBeats()
    {
        $beats = Beat::orderBy('created_at', 'DESC')->paginate(10);

        return BeatsResource::collection($beats)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $data = $request->validate([
            'about' => 'required',
            'cover'  => 'required|image|mimes:jpg,png,jpeg',
            'title' => 'required',
            'tags' => 'required',
            'price' => 'required',
            'key'  => 'required',
            'basic'  => 'required',
            'premium'  => 'required',
            'unlimited'  => 'required',
            'sample'  => 'required|mimes:application/octet-stream,mpeg,mpga,mp3,wav',
        ]);

        $beatImgFile =  $request->file('cover');
        $beatImgFileName = time()."BI".strtolower(str_replace(' ', '_',$beatImgFile->getClientOriginalName()));

        $BeatSampleFile =  $request->file('sample');
        $BeatSampleFileName = time()."BS".strtolower(str_replace(' ', '_',$BeatSampleFile->getClientOriginalName()));

        if( $beatImgFile->storeAs('public/beats/covers/', $beatImgFileName )  &&  $BeatSampleFile->storeAs('public/beats/samples/', $BeatSampleFileName ) ){


            $data['sample'] = $BeatSampleFileName;
            $data['cover'] =$beatImgFileName;

             Beat::create($data);

            return response('Beat Created', Response::HTTP_CREATED);

        }else{
            return response('Can not Create Beat', Response::HTTP_FORBIDDEN);
        }

    }


    public function show(Beat $beat)
    {
        return (new BeatsResource($beat))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function update(Request $request, Beat $beat)
    {
        $data = $request->validate([
            'about' => 'required',
            'cover'  => 'required|image|mimes:jpg,png,jpeg',
            'title' => 'required',
            'tags' => 'required',
            'price' => 'required',
            'key'  => 'required',
            'basic'  => 'required',
            'premium'  => 'required',
            'unlimited'  => 'required',
            'sample'  => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ]);


        $beatImgFile =  $request->file('cover');
        $beatImgFileName = time()."BI".strtolower(str_replace(' ', '_',$beatImgFile->getClientOriginalName()));



        $BeatSampleFile =  $request->file('sample');
        $BeatSampleFileName = time()."BS".strtolower(str_replace(' ', '_',$BeatSampleFile->getClientOriginalName()));

        if( $beatImgFile->storeAs('public/beats/covers/', $beatImgFileName )  &&  $BeatSampleFile->storeAs('public/beats/samples/', $BeatSampleFileName )){

            $beatImg = 'public/beats/covers/'.$beat->cover;
            $beatSample = 'public/beats/samples/'.$beat->sample;

            if(Storage::exists($beatImg) && Storage::exists($beatSample)){

                $data['cover'] = $beatImgFileName;
                $data['sample'] = $BeatSampleFileName;

                if($beat->update($data)){

                    return response('Beat Updated!', Response::HTTP_CREATED);

                }else{

                    return response('Can not Update Beat', Response::HTTP_FORBIDDEN);

                }

            }else{

                $replacerImgName = 'public/beats/covers/'.$beatImgFileName;
                $replacerSampleName = 'public/beats/samples/'.$BeatSampleFileName;
                Storage::delete([$replacerImgName,$replacerSampleName]);

                return response('Failed To Update Beat Image', Response::HTTP_FORBIDDEN);
            }

        }else{
            return response('Can not Update Beat', Response::HTTP_FORBIDDEN);
        }
    }

    public function download(Beat $beat){

//        rewrite
        $pathToFile = 'public/beats/zips/'.$beat->beat;

        $headers = array(
            'Content-Type : application/octet-stream',
            'Content-Disposition : attachment; filename="'.$beat->title.'".zip"',
        );

        return Storage::download($pathToFile, $beat->title, $headers)->setStatusCode(Response::HTTP_OK);

    }



    public function destroy(Beat $beat)
    {
        $beatImg = 'public/beats/covers/'.$beat->cover;
        $beatSample = 'public/beats/samples/'.$beat->sample;
        $beatZip = 'public/beats/zips/'.$beat->beat;


        if(Storage::exists($beatImg) && Storage::exists($beatZip) && Storage::exists($beatSample) && Storage::delete([$beatImg,$beatZip,$beatSample])){

            if($beat->delete()){
                return response('Beat Deleted', Response::HTTP_OK);
            }else{
                return response('Deleted Unable To Delete Beat', Response::HTTP_FORBIDDEN);
            }

        }else{
            return response('Not Found', Response::HTTP_FORBIDDEN);
        }

    }
}
