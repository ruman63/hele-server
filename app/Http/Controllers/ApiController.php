<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use Storage;
use Image;

class ApiController extends Controller
{

  /**
   *@return \Illuminate\Http\Response
   */
    public function getAll(){
      $places = Place::select(['id', 'name', 'location', 'category_id'])->get();
      $destinationList = [];
      $i=0;
      foreach($places as $place){
        $destination = [];
        $destination['id'] = $place->id;
        $destination['name'] = $place->name;
        $destination['location'] = $place->location;

        $photos = $place->photos;
        $filename = $photos[0]->name;
        $file  = Image::make(public_path('images/'.$filename))->fit(640,360)->encode();

        $destination['thumb'] = base64_encode($file);

        $destination['category'] = $place->category->name;

        $destinationList[$i++] = $destination;

      }
      return response()->json($destinationList,200);
    }
    public function getPhotos($place_id){
      $place = Place::find($place_id);
      $photos = $place->photos;
      $filename = $photos[0]->name;
      $file  = Image::make(public_path('images/'.$filename))->fit(196,196)->encode();
      return response()->json(base64_encode($file));
    }
}
