@extends('main')

@section('title', '| Add New Place')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Add New Place</h1>
        {!! Form::open(['route' => ['places.store'], 'method' => 'POST', 'files'=>true]) !!}
          <label for="name" class="form-spacing-top">Name:</label>
          <input type="text" name="name" value="" class="form-control">

          <label for="location" class="form-spacing-top">Location:</label>
          <input type="text" name="location" value="" class="form-control">

          <label for="nearest_to" class="form-spacing-top">Nearest Station:</label>
          <input type="text" name="nearest_to" value="" class="form-control">

          <label for="category_id" class="form-spacing-top">Category:</label>
          <select type="text" name="category_id" value="" class="form-control">
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach
          </select>

          <label for="tags" class="form-spacing-top">Tags:</label>
          <select name="tags[]" class="form-control multiple-select" multiple="multiple">
            @foreach ($tags as $tag)
              <option value="{{$tag->id}}">{{ $tag->name }}</option>
            @endforeach
          </select>

          {{ Form::label('images', 'Upload Images: ', ['class' => 'form-spacing-top']) }}
          {{ Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) }}

          <label for="description" class="form-spacing-top">Description:</label>
          <textarea type="text" name="description" value="" class="form-control" rows="8"></textarea>

          <input type="submit" value="Add Place" class="btn btn-success btn-block btn-h1-spacing">
        </form>
      </div>
    </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script type="text/javascript">
      $('.multiple-select').select2();
  </script>
@endsection
