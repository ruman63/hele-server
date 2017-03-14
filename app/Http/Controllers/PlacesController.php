<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Tag;
use App\Category;
use Session;
use App\Photo;
use Image;
use Storage;
class PlacesController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::orderBy('id', 'desc')->paginate(10);
        return view('places.index')->withPlaces($places);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tags = Tag::all();
      $categories = Category::all();
      return view('places.create')->withTags($tags)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $place = new Place;
        $rules = [
          'name' => 'required|min:3|max:255',
          'location' => 'required|min:5|max:255',
          'nearest_to' => 'max:255',
          'description' => 'required|min:20|max:6000',
          'category_id' => 'required'
        ];
        if($request->hasFile('images')){
          foreach ($request->file('images') as $index => $image) {
            $rules['images.'.$index] = 'required|image';
          }
        }
        $this->validate($request, $rules);
        $photos=[];
        if($request->hasFile('images')) {
          $images = $request->file('images');
          $i=0;
          foreach($images as $imageFile){
            $photo = new Photo;
            $filename = $request->name . '_' . time() ."_$i." . $imageFile->getClientOriginalExtension();
            $location = public_path('images/' . $filename);

            Image::make($imageFile)->fit(800,600, function($const){ $const->upsize();})->save($location);

            $photo->name = $filename;

            $photos[$i++] = $photo;
          }
        }

        $place->name = $request->name;
        $place->location = $request->location;
        $place->nearest_to = $request->nearest_to;
        $place->description = $request->description;
        $place->category_id = $request->category_id;
        $place->save();


        $place->photos()->saveMany($photos);

        if(isset($request->tags)){
          $place->tags()->sync($request->tags);
        } else {
          $place->tags()->sync([]);
        }

        Session::flash('success', 'Place added successfully');

        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $place = Place::find($id);
      return view('places.show')->withPlace($place);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        $alltags = Tag::all();
        $tags = [];
        foreach ($alltags as $tag) {
          $tags["$tag->id"] = $tag->name;
        }
        $categories = Category::all();
        return view('places.edit')->withPlace($place)->withTags($tags)->withCategories($categories);
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
      $place = Place::find($id);

      $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'location' => 'required|min:5|max:255',
        'nearest_to' => 'max:255',
        'description' => 'required|min:20|max:6000',
        'category_id' => 'required'
      ]);

      $place->name = $request->name;
      $place->location = $request->location;
      $place->nearest_to = $request->nearest_to;
      $place->description = $request->description;
      $place->category_id = $request->category_id;

      $place->save();

      if(isset($request->tags)){
        $place->tags()->sync($request->tags);
      } else {
        $place->tags()->sync([]);
      }

      Session::flash('success', 'Place updated successfully');

      return redirect()->route('places.show', $place->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::find($id);
        $place->tags()->detach();
        foreach ($place->photos as $photo) {
          Storage::delete($photo->name);
        }
        $place->delete();

        Session::flash('success', 'Place deleted successfully');
        return redirect()->route('places.index');
    }
}
