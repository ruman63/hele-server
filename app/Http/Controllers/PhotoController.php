<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Place;
use Image;
use Session;
use Redirect;
use Storage;

class PhotoController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $photos = Photo::orderBy('place_id')->paginate(24);
      return view('photos.index')->withPhotos($photos);
    }

    public function add($place_id){
      return view('photos.add')->withId($place_id);
    }

    public function store(Request $request, $place_id) {
      $place = Place::find($place_id);
      $cloudDisk = Storage::disk('s3');

      $rules = ['images' => 'required'];
      if(count($request->images) > 0)
        foreach ($request->file('images') as $index => $image) {
          $rules['images.'.$index] = 'required|image';
        }

      $this->validate($request, $rules);

      $images = $request->file('images');
      $photos=[];
      $i=0;

      //Saving Images
      foreach($images as $imageFile){
        $photo = new Photo;
        $place->photos()->save($photo);

        //File name & relative path
        $filename = "$photo->id." . $imageFile->getClientOriginalExtension();
        $path = "$place->name/" . $filename;

        //Upload

        //Original Version
        $size = config('s3images.size.original');
        $folder = config('s3images.folder.original') . $path;
        $file = Image::make($imageFile)->fit($size['width'], $size['height'], function($constraint){
          $constraint->upsize();
        })->encode();
        $cloudDisk->put($folder, $file->__toString(), 'public');

        //Thumbnail Version
        $size = config('s3images.size.thumb');
        $folder = config('s3images.folder.thumb') . $path;
        $file = Image::make($imageFile)->fit($size['width'], $size['height'], function($constraint){
          $constraint->upsize();
        })->encode();
        $cloudDisk->put($folder, $file->__toString(), 'public');

        //Mobile Version
        $size = config('s3images.size.mobileapi');
        $folder = config('s3images.folder.mobileapi') . $path;
        $file = Image::make($imageFile)->fit($size['width'], $size['height'], function($constraint){
          $constraint->upsize();
        })->encode();
        $cloudDisk->put($folder, $file->__toString(), 'public');

        $photo->name = $path;
        $place->photos()->save($photo);

      }
      //Images Uploaded
      Session::flash('success', 'Images added successfully');
      return Redirect::route('places.show', $place_id);
  }

  public function showPlace($place_id){
    $photos = Photo::where('place_id', '=', $place_id)->paginate(20);
    return view('photos.show')->withPhotos($photos);
  }

  public function show($id){
    $photo = Photo::find($id);
    $filename = config('s3images.folder.original') . $photo->name;
    if(Storage::disk('s3')->exists($filename)){
      $url = config('s3images.url.original').$photo->name;
    } else {
      $url = config('s3images.url.noimage');
    }
    return Redirect::away($url);
  }

  public function destroy($id){
    $photo = Photo::find($id);
    $disk = Storage::disk('s3');

    //delete original image if exist
    $filename = config('s3images.folder.original') . $photo->name;
    if($disk->exists($filename))
      $disk->delete($filename);

    //delete thumb if exist
    $filename = config('s3images.folder.thumb') . $photo->name;
    if($disk->exists($filename))
      $disk->delete($filename);

    //delete api image if exist
    $filename = config('s3images.folder.mobileapi') . $photo->name;
    if($disk->exists($filename))
      $disk->delete($filename);


    $photo->delete();

    return Redirect::route('photos.index');
  }
}
