@extends('main')

@section('title', '| Add Photos')

@section('content')

  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      {!! Form::open(['route' => ['photos.store', $id], 'method' => 'POST', 'files' => true]) !!}
        {{ Form::label('images', 'Select Photos: ', ['class'=> 'form-spacing-top']) }}
        {{ Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) }}
        {{ Form::submit('Add Photos', ['class' => 'btn btn-primary form-spacing-top']) }}
    </div>
  </div>

@endsection
