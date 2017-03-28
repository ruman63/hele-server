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
    public function allPlaces(){
      $places = Place::select(['id', 'name', 'category_id'])->orderBy('name')->get();
      $destinationList = $this->makeList($places);
      return response()->json($destinationList,200);
    }

    public function details($id){
      $place  = Place::find($id);
      return response()->json($place);
    }

    public function showRefine(){
      $cat = Category::all();
      $cats = [];
      foreach ($cat as $category) {
        $cats[$category->id] = $category->name;
      }
      return view('api.refine')->withCategories($cats)->withErrors([]);
    }
    public function refinePlaces(Request $request){
      $places = Place::select();

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
        $places = $places->orWhere( function ($query) use ($related){
          $query->whereIn('id', $related);
        });
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

      $places = $places->paginate(5);
      return response()->json($this->makeList($places));

    }

    public function allCategories(){
      $categories = Category::select('id', 'name')->get();
      return response()->json($this->makeCategoriesList($categories), 200);
    }

    private function makeList($places){
      $destinationList = ['meta' => [
        'current' => $places->currentPage() ,
        'last' => $places->lastPage()
      ],
        'data' => []
      ];
      $i=0;
      foreach($places as $place){
        $destination = [];
        $destination['id'] = $place->id;
        $destination['name'] = $place->name;
        $destination['location'] = $place->location;

        $allphotos = $place->photos;
        if(count($allphotos) > 0){
          $filepath = config('s3images.url.mobileapi').urlencode($allphotos[0]->name);
        }
        else {
          $filepath = config('s3images.url.noimage-api');
        }

        $destination['thumb'] = $filepath;

        $destination['category'] = $place->category->name;

        $destinationList['data'][$i++] = $destination;

      }
      return $destinationList;
    }

    private function makeCategoriesList($categories){
      $categoryList = [];
      $i = 0;
      foreach ($categories as $category) {
        $cat = [];
        $cat['id'] = $category->id;
        $cat['name'] = $category->name;

        $categoryList[$i++] = $cat;
      }

      return $categoryList;
    }
}
