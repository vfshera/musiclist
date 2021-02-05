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
        $drumkits = Drumkit::orderBy('created_at', 'DESC')->paginate(12);

        return DrumkitsResource::collection($drumkits)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function getRandomName(int $num){

        $nm = ($num && $num > 0) ? $num : 10;

        $randomName = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $finalname = substr($randomName, 0, $nm);

        return $finalname;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',
            'image'  => 'required|image|mimes:jpg,png,jpeg',
            'title' => 'required',
            'type' => 'required',
            'price' => 'required',
            'drumlink'  => 'required',
            'sample'  => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ]);

        $drumkitImgFile =  $request->file('image');
        $drumkitImgFileName = $this->getRandomName(10)."_DI_".time().'.'.$drumkitImgFile->getClientOriginalExtension();

        $DrumkitSampleFile =  $request->file('sample');
        $DrumkitSampleFileName = $this->getRandomName(10)."_DS_".'.'.time().$DrumkitSampleFile->getClientOriginalExtension();

        if( $drumkitImgFile->storeAs('public/drumkits/covers/', $drumkitImgFileName )  &&  $DrumkitSampleFile->storeAs('public/drumkits/samples/', $DrumkitSampleFileName ) ){


            $data['sample'] = $DrumkitSampleFileName;
            $data['image'] =$drumkitImgFileName;
            Drumkit::create($data);

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
            'price' => 'required',
            'drumlink'  => 'required',
            'sample'  => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
        ]);


        $drumkitImgFile =  $request->file('image');
        $drumkitImgFileName = $this->getRandomName(10)."_DI_".time().'.'.$drumkitImgFile->getClientOriginalExtension();

        $DrumkitSampleFile =  $request->file('sample');
        $DrumkitSampleFileName = $this->getRandomName(10)."_DS_".time().'.'.$DrumkitSampleFile->getClientOriginalExtension();

        if( $drumkitImgFile->storeAs('public/drumkits/covers/', $drumkitImgFileName )  &&  $DrumkitSampleFile->storeAs('public/drumkits/samples/', $DrumkitSampleFileName ) ){

            $drumImg = 'public/drumkits/covers/'.$drumkit->image;
            $drumSample = 'public/drumkits/samples/'.$drumkit->sample;

            if(Storage::exists($drumImg) && Storage::exists($drumSample) && Storage::delete([$drumImg,$drumSample])){

                $data['image'] = $drumkitImgFileName;
                $data['sample'] = $DrumkitSampleFileName;

                if($drumkit->update($data)){

                    return response('Drumkit Updated!', Response::HTTP_CREATED);

                }else{

                    return response('Can not Update Drumkit', Response::HTTP_FORBIDDEN);

                }

            }else{

                $replacerImgName = 'public/drumkits/covers/'.$drumkitImgFileName;
                $replacerSampleName = 'public/drumkits/samples/'.$DrumkitSampleFileName;
                Storage::delete([$replacerImgName,$replacerSampleName]);

                return response('Failed To Update Drumkit Image', Response::HTTP_FORBIDDEN);
            }

        }else{
            return response('Can not Update Drumkit', Response::HTTP_FORBIDDEN);
        }
    }

    public function download(Drumkit $drumkit){

//        to be changed
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
        $drumSample = 'public/drumkits/samples/'.$drumkit->drumkit;

        if(Storage::exists($drumImg) && Storage::exists($drumSample) && Storage::delete([$drumImg,$drumSample])){

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
