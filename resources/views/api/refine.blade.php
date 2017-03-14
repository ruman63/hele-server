@extends('main')
@section('title', 'Testing Api')
@section('content')

{!! Form::open(['url' => url('api/refine'), 'method' => 'POST']) !!}
{{ Form::select('category', $categories, null,['class' => 'form-control']) }}

{{ Form::label('searchString', 'Search: ') }}
{{ Form::text('searchString', null,  ['class' => 'form-control'] ) }}

{{ Form::label('sortColumn', 'Sort Column: ') }}
{{ Form::text('sortColumn', null,  ['class' => 'form-control'] ) }}

{{ Form::label('sortOrder', 'Sort Order: ') }}
{{ Form::text('sortOrder', null,  ['class' => 'form-control'] ) }}
{{ Form::submit("Send") }}
{!! Form::close() !!}

@endsection
