@extends('main')
@section('title', '| Photos -'.htmlspecialchars($photos[0]->place->name))

@section('content')
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1">
      <h1>{{$photos[0]->place->name}} - Photos</h1>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-10 col-md-offset-1">
      @foreach ($photos as $photo)
        <div class="col-xs-6 col-md-3">
          <div class="well">
            <a href="{{ route('photos.show', $photo->id) }}" ><img class="img-thumbnail" src="{{ asset('public/images/'.$photo->name) }}" alt="{{ $photo->name }}"></a>
            <div class="text-center">
                {!! Form::open(['route' => ['photos.destroy', $photo->id], 'method' => 'DELETE']) !!}
                  {{ Form::submit('Delete', ['class' => 'btn btn-danger form-spacing-top']) }}
                {!! Form::close() !!}
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    <div class="row text-center">
      {{ $photos->links() }}
    </div>
  </div>
@endsection
