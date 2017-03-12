<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
class DestinationController extends Controller
{
    public function getDestinations() {
        $places = Place::orderBy('id', 'desc')->paginate(10);
        return view('destinations.overview')->withPlaces($places);
    }

    public function show($id) {
      $place = Place::find($id);
      return view('destinations.show')->withPlace($place);
    }
}
