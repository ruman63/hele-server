@extends('main')
@section('title', '| Place - '.htmlspecialchars($place->name))
@section('content')
  <div class="row">
    <div class="col-md-8">
      <h1>{{ $place->name }}</h1>
      <p class="lead">
        {{ $place->description }}
      </p>
      <hr>
      @foreach ($place->tags as $tag)
        <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
      @endforeach
    </div>
    <div class="col-md-4 well">
      <h3 class="text-center">Place Info</h3>
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
      <div class="col-md-6">
        <a href="{{ route('places.edit', $place->id) }}" class="btn btn-primary btn-block">Edit</a>
      </div>
      <div class="col-md-6">
        <a href="{{ route('places.destroy', $place->id) }}" class="btn btn-danger btn-block">Delete</a>
      </div>
    </div>
  </div>
@endsection
