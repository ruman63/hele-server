<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Redirect;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $review = new Review;

        $this->validate($request, [
          'name' => 'required|min:4|max:255',
          'email' => 'required|email',
          'rating' => 'required|between:1,5',
          'comment' => 'required|min:20|max:1000',
        ]);

        $review->name = $request->name;
        $review->email = $request->email;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->place_id = $post_id;

        $review->save();

        return Redirect::route('destinations.show', $post_id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
