@extends('main')

@section('title', '| Destinations')

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="row head">
          <h1>Recent Destinations</h1>
      </div>
      @foreach ($places as $place)
        <div class="row">
          <div class="col-xs-12 well">
              <div class="col-xs-5 col-md-3">
                <img class="img-responsive" src="{{ ($place->photos()->count() >0) ? asset('images/'. $place->photos[0]->name) : "" }}" >
              </div>
              <div class="col-xs-12 col-md-9">
                <a href="{{ route('destinations.show', $place->id) }}"><h3>{{ $place->name }} <small>{{ $place->location }}</small></h3></a>
                <h4>Category: {{ $place->category->name }}</h4>
                <p>{{ substr($place->description,0,300)  }}{{ strlen($place->description) > 300 ? "..." : "" }}</p>
                @foreach ($place->tags as $tag)
                  <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
                <br>
              </div>
          </div>
        </div>
      @endforeach
      <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
          {{ $places->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
