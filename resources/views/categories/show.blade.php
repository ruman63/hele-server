@extends('main')
@section('title', "|  ".htmlspecialchars($category->name))
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>{{ $category->name }}</h1><br>
      <table class="table">
        <thead>
          <th>#</th>
          <th>Name</th>
          <th>Location</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($category->places as $place)
            <tr>
              <td>{{ $place->id }}</td>
              <td>{{ $place->name }}</td>
              <td>{{ $place->location }}</td>
              <td><a href="{{ route('places.show', $place->id) }}" class="btn btn-default btn-sm">View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
