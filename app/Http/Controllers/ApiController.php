<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Category;
use App\Tag;
use DB;
use Storage;
use Session;
use Image;

class ApiController extends Controller
{

  /**
   *@return \Illuminate\Http\Response
   */
    public function listAll(){
      $places = Place::select(['id', 'name', 'category_id'])->get();
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

    public function details($id){

    }

    public function showRefine(){
      $cat = Category::all();
      $cats = [];
      foreach ($cat as $category) {
        $cats[$category->id] = $category->name;
      }
      return view('api.refine')->withCategories($cats)->withErrors([]);
    }
    public function refine(Request $request){
      $places = Place::getQuery();

      $search = $request->searchString;

      if(isset($search)){
        $keys = preg_split('/\s/', $search);
        foreach ($keys as $key) {
          $places = $places->orWhere('name', 'like', "%$key%");
        }
        $tags= Tag::whereIn('name', $keys)->get();
        $related = [];
        foreach($tags as $tag){
            foreach ($tag->places()->allRelatedIds() as $id) {
              array_push($related, $id);
            }
        }
        array_unique($related);
        if(count($related) > 0)
        $places = $places->whereIn('id', $related);
      }

      $sortColumn=$request->input('sortColumn');
      $sortOrder=$request->input('sortOrder');

      if(isset($request->category)){
        $places = $places->where('category_id', '=', $request->category);
      }

      if(isset($sortColumn) && isset($sortOrder)){
        $places = $places->orderBy($sortColumn, $sortOrder);
      }
      else if(isset($sortColumn)){
        $places = $places->orderBy($sortColumn);
      }


      $places = $places->get();

      return response()->json($places);

    }
}
