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
              <div class="col-xs-4 col-md-3">
                @if( $place->photos()->count() >0  &&  Storage::disk('s3')->exists( config('s3images.folder.thumb') . $place->photos[0]->name ) )
                  <img class="img-responsive" src="{{ config('s3images.url.thumb') . $place->photos[0]->name }}" >
                @else
                  <img class="img-responsive" src="{{ config('s3images.url.noimage-thumb') }}" >
                @endif
              </div>
              <div class="col-xs-12 col-md-9">
                <h3><a href="{{ route('destinations.show', $place->id) }}">{{ $place->name }}</a> <small>{{ $place->city }}</small></h3>
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
