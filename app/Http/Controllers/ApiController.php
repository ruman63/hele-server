<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
class ApiController extends Controller
{

  /**
   *@return \Illuminate\Http\Response
   */
    public function getAll(){
      $places = Place::all();
      return response()->json($places,200);
    }
}
