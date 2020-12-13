<?php

namespace App\Http\Controllers;

use App\Beat;
use App\Http\Resources\BeatsResource;
use Illuminate\Http\Request;
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
            'beat'  => 'required|mimes:zip,application/x-zip-compressed',
            'sample'  => 'required|mimes:application/octet-stream,mpeg,mpga,mp3,wav',
        ]);

        $beatImgFile =  $request->file('cover');
        $beatImgFileName = time()."_"."BEAT_IMG_".strtolower(str_replace(' ', '_',$beatImgFile->getClientOriginalName()));

        $BeatZipFile =  $request->file('beat');
        $randomName = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $dzipMidName = substr($randomName, 0, 10);
        $BeatZipFileName = "BZIP_".$dzipMidName."_".time().".zip";

        $BeatSampleFile =  $request->file('sample');
        $BeatSampleFileName = time()."_"."BEAT_SAMPLE_".strtolower(str_replace(' ', '_',$BeatSampleFile->getClientOriginalName()));

        if( $beatImgFile->storeAs('public/beats/covers/', $beatImgFileName )  &&  $BeatSampleFile->storeAs('public/beats/samples/', $BeatSampleFileName )  && $BeatZipFile->storeAs('public/beats/zips/', $BeatZipFileName ) ){

            $data['beat'] = $BeatZipFileName;
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
            'beat'  => 'required|mimes:zip',
            'sample'  => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ]);


        $beatImgFile =  $request->file('cover');
        $beatImgFileName = time()."_"."BEAT_IMG_".strtolower(str_replace(' ', '_',$beatImgFile->getClientOriginalName()));

        $BeatZipFile =  $request->file('beat');
        $randomName = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $dzipMidName = substr($randomName, 0, 10);
        $BeatZipFileName = "BZIP_".$dzipMidName."_".time().".zip";

        $BeatSampleFile =  $request->file('sample');
        $BeatSampleFileName = time()."_"."BEAT_SAMPLE_".strtolower(str_replace(' ', '_',$BeatSampleFile->getClientOriginalName()));

        if( $beatImgFile->storeAs('public/beats/covers/', $beatImgFileName )  &&  $BeatSampleFile->storeAs('public/beats/samples/', $BeatSampleFileName )  && $BeatZipFile->storeAs('public/beats/zips/', $BeatZipFileName ) ){

            $beatImg = 'public/beats/covers/'.$beat->image;
            $beatSample = 'public/beats/samples/'.$beat->sample;
            $beatZip = 'public/beats/zips/'.$beat->drumkit;

            if(Storage::exists($beatImg) && Storage::exists($beatZip) && Storage::exists($beatSample) && Storage::delete([$beatImg,$beatZip,$beatSample])){

                $data['cover'] = $beatImgFileName;
                $data['beat'] = $BeatZipFileName;
                $data['sample'] = $BeatSampleFileName;

                if($beat->update($data)){

                    return response('Beat Updated!', Response::HTTP_CREATED);

                }else{

                    return response('Can not Update Beat', Response::HTTP_FORBIDDEN);

                }

            }else{

                $replacerImgName = 'public/beats/covers/'.$beatImgFileName;
                $replacerZipName = 'public/beats/zips/'.$BeatZipFileName;
                $replacerSampleName = 'public/beats/samples/'.$BeatSampleFileName;
                Storage::delete([$replacerImgName,$replacerZipName,$replacerSampleName]);

                return response('Failed To Update Beat Image', Response::HTTP_FORBIDDEN);
            }

        }else{
            return response('Can not Update Beat', Response::HTTP_FORBIDDEN);
        }
    }

    public function download(Beat $beat){
        $pathToFile = 'public/beats/zips/'.$beat->drumkit;

        $headers = array(
            'Content-Type : application/octet-stream',
            'Content-Disposition : attachment; filename="'.$beat->title.'".zip"',
        );

        return Storage::download($pathToFile, $beat->title, $headers)->setStatusCode(Response::HTTP_OK);

    }



    public function destroy(Beat $beat)
    {
        $beatImg = 'public/beats/covers/'.$beat->image;
        $beatSample = 'public/beats/samples/'.$beat->sample;
        $beatZip = 'public/beats/zips/'.$beat->drumkit;


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
