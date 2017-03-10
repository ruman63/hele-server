<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getIndex(){
      return view('pages.index');
    }
    public function getContact() {
      return view('pages.contact');
    }
    public function getAbout() {
      return view('pages.about');
    }
}
