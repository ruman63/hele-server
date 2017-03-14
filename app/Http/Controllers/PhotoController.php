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
      $rules = ['images' => 'required'];
      foreach ($request->file('images') as $index => $image) {
        $rules['images.'.$index] = 'required|image';
      }
      $this->validate($request, $rules);

      $images = $request->file('images');
      $photos=[];
      $i=0;
      foreach($images as $imageFile){
        $photo = new Photo;
        $filename = $place->name. '_' . time() ."_$i."  . $imageFile->getClientOriginalExtension();
        $location = public_path('images/' . $filename);

        Image::make($imageFile)->fit(800,600, function($constraint){
          $constraint->upsize();
        })->save($location);

        $photo->name = $filename;
        $photos[$i++] = $photo;
      }
      $place->photos()->saveMany($photos);

      Session::flash('success', 'Images added successfully');

      return Redirect::route('places.show', $place_id);
  }

  public function showPlace($place_id){
    $photos = Photo::where('place_id', '=', $place_id)->paginate(20);
    return view('photos.show')->withPhotos($photos);
  }

  public function show($id){
    $photo = Photo::find($id);
    return Redirect::to(public_path('images/' . $photo->name));
  }

  public function destroy($id){
    $photo = Photo::find($id);
    Storage::delete($photo->name);
    $photo->delete();

    return Redirect::route('photos.index');
  }
}
