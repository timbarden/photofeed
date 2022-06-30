<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;
use DateTime;
use Image;

class PhotosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Post::all();
        return view('photos/index', ['photos' => Photo::orderBy('date_taken', 'desc')->paginate(50) ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request, [
            'image.*' => 'required'
        ]);

        $arrFiles = $request->file("image");
        
        foreach($arrFiles as $file){

            // unique filename
            $fileNameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $newFileName = time();
            $filenameToStore = $filename."_".$newFileName.".".$ext;
            $path = $file->storeAs("public/cover_images", $filenameToStore); 
            
            // exif data
            $exif = exif_read_data($file);
            $exifDate = "1970:01:01 00:00:00";
            if (gettype($exif)){
                if (array_key_exists("DateTimeOriginal", $exif)){
                    $exifDate = $exif["DateTimeOriginal"];
                }
            }
            
            // thumbnail image
            $thumbToStore = $filename."_".$newFileName."_thumb.".$ext;
            $thumbnail = Image::make($file);
            $thumbnail->orientate()->fit(300, 300);
            $thumbnail->save("storage/cover_images/".$thumbToStore, 90, "jpg");
            
            //Create new photo
            $photo = new Photo;
            $photo->user_id = $request->user()->id; // or auth()->user->id
            $photo->date_taken = strtotime($exifDate);
            $photo->full_image = $filenameToStore;
            $photo->thumb_image = $thumbToStore;
            $photo->save();
        }
      return redirect('/photos')->with('success', 'Photo(s) uploaded');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Post::find($id);
        return view('photos/show', ['photo' => Photo::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $photo = Photo::find($id);
        // check for correct user
        if (auth()->user()->id !== $photo->user_id){
            return redirect('/photos')->with('error', 'Unauthorized Page');            
        }

        return view('photos/edit', ['photo' => Photo::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate ($request, [
            'date_taken' => 'required'
        ]);

        $date = new DateTime($request->input('date_taken'));
        $timestamp = $date->getTimestamp();

        // Create new post
        $photo = Photo::find($id);
        $photo->date_taken = $timestamp;
        $photo->save();

        return redirect('/photos')->with('success', 'Photo updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        // check for correct user
        if (auth()->user()->id !== $photo->user_id){
            return redirect('/photos')->with('error', 'Unauthorized Page');            
        }

        $photo->delete();
        Storage::delete('public/cover_images/'.$photo->full_image);
        Storage::delete('public/cover_images/'.$photo->thumb_image);

        return redirect('/photos')->with('success', 'Image deleted');
    }
}
