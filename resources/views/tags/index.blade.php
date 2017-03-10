@extends('main')
@section('title', '| All Tags')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">

    <div class="col-md-8">
        <h1>All Tags</h1><br>
        <table class="table">
          <thead>
            <th>#</th>
            <th>Tag</th>
            <th></th>
          </thead>
          <tbody>
            @foreach ($tags as $tag)
              <tr>
                <td>{{ $tag->id }}</td>
                <td id="category-name"><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                <td>
                  <form class="pull-right" action="{{ route('tags.destroy', $tag->id) }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                    <button type="button" data-toggle="collapse" data-target="#edit-{{ $tag->id }}" class="btn btn-primary btn-sm accordian-toggle">Edit</button>
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                  </form>
                </td>
              </tr>
              <tr>
                <td></td>
                <td class="hiddenRow">
                  <div id="edit-{{ $tag->id }}" class="accordian-body collapse">
                    <div class="panel panel-default">
                      <div class="panel-heading">Edit Tag</div>
                      <div class="panel-body">
                        <form class="inline" action="{{ route('tags.update', $tag->id) }}" method="post">
                          <input type="hidden" name="_method" value="PUT">
                          {{ csrf_field() }}
                          <input type="text" name="name" value="{{ $tag->name }}">
                          <input type="submit" value="Save" class="btn btn-primary btn-sm">
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    <div class="panel panel-default col-md-4">
      <div class="panel-heading">Add Tag</div>
      <div class="panel-body">
        <form class="form-inline" action="{{ route('tags.store') }}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name" class="sr-only">Name: </label>
            <input type="text" name="name" placeholder="Tags" class="form-control">
          </div>
          <input type="submit" value="Add" class="btn btn-success">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
