@extends('main')
@section('title', '| Place - '.htmlspecialchars($place->name))
@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8">
      <h1>{{ $place->name }}</h1>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8">
      <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="pull-left h2">Photos <small>({{ $place->photos()->count() }} total)</small></div>
                    <div class="pull-right">
                      <a class="btn btn-primary" href="{{ route('photos.add', $place->id) }}"><span class="glyphicon glyphicon-plus"></span> Add Photos</a>
                    </div>
                  </div>
                </div>
              </div>
              @if($place->photos()->count() > 0)
              <div class="panel-body">
                <div class="row">
                  @foreach ($place->photos as $photo)
                      <a href="{{ route('photos.show', $photo->id) }}" ><img class="image-showcase" src="{{ config('s3images.url.thumb') . $photo->name }}" width = "150px" alt="{{ $photo->name }}"></a>
                  @endforeach
                  <a href="{{ route('photos.showplace', $place->id) }}">See all >></a>
                </div>
              </div>
            @endif
            </div>
          </div>
      </div>
      <p>
        {{ $place->description }}
      </p>
      <hr>
      <div class="tags">
      @foreach ($place->tags as $tag)
        <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
      @endforeach
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
      <div class="well">
        <h3 class="text-center">Place Info</h3>
        <label>City:</label>
        <p>
          {{ $place->city }}
        </p>
        <label>Location:</label>
        <p>
          {{ $place->location }}
        </p>
        <label>Nearest Station:</label>
        <p>
          {{ $place->nearest_to }}
        </p>
        <label>Category:</label>
        <p>
          {{ $place->category->name }}
        </p>
        <div class="row">
          <div class="col-xs-6">
            <a href="{{ route('places.edit', $place->id) }}" class="btn btn-primary btn-block">Edit</a>
          </div>
          <div class="col-xs-6">
            {!! Form::open(['route' => ['places.destroy', $place->id], 'method' => 'DELETE']) !!}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
