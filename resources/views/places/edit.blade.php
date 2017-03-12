@extends('main')

@section('title', '| Edit Place')

@section('styles')
  <link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Edit - {{ $place->name }}</h1>
        {{ Form::model($place, ['route' => ['places.update', $place->id], 'method' => "PUT" ]) }}
          <label for="name" class="form-spacing-top">Name:</label>
          <input type="text" name="name" value="{{ $place->name }}" class="form-control">

          <label for="location" class="form-spacing-top">Location:</label>
          <input type="text" name="location" value="{{ $place->location }}" class="form-control">

          <label for="nearest_to" class="form-spacing-top">Nearest Station:</label>
          <input type="text" name="nearest_to" value="{{ $place->nearest_to }}" class="form-control">

          <label for="category_id" class="form-spacing-top">Category:</label>
          <select type="text" name="category_id" value="{{ $place->category_id }}" class="form-control">
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach
          </select>

          <label for="tags" class="form-spacing-top">Tags:</label>
          {{ Form::select('tags[]', $tags, null, ['class' => 'form-control multiple-select', 'multiple'=>'multiple']) }}

          <label for="description" class="form-spacing-top">Description:</label>
          <textarea type="text" name="description" class="form-control" rows="8">{{ $place->description }}</textarea>

          <input type="submit" value="Save Changes" class="btn btn-success btn-block btn-h1-spacing">
        {{ Form::close() }}
      </div>
    </div>
@endsection

@section('scripts')
  <script src="{{ asset('public/js/select2.min.js') }}"></script>
  <script type="text/javascript">
      $('.multiple-select').select2();
      $('.multiple-select').select2().val( {{json_encode($place->tags()->allRelatedIds()) }}).trigger('change');
   </script>
@endsection
