@extends('main')
@section('title', '| All Categories')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">

    <div id="category-show" class="col-md-8">
        <h1>All Categories</h1><br>
        <div id='edit-category'>

        </div>
        <table class="table">
          <thead>
            <th>#</th>
            <th>Category</th>
            <th></th>
          </thead>
          <tbody>
            @foreach ($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td id="category-name"><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></td>
                <td>
                  <form class="pull-right" action="{{ route('category.destroy', $category->id) }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                    <button type="button" data-toggle="collapse" data-target="#edit-{{ $category->id }}" class="btn btn-primary btn-sm accordian-toggle">Edit</button>
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                  </form>
                </td>
              </tr>
              <tr>
                <td></td>
                <td class="hiddenRow">
                  <div id="edit-{{ $category->id }}" class="accordian-body collapse">
                    <div class="panel panel-default">
                      <div class="panel-heading">Edit Category</div>
                      <div class="panel-body">
                        <form class="inline" action="{{ route('category.update', $category->id) }}" method="post">
                          <input type="hidden" name="_method" value="PUT">
                          {{ csrf_field() }}
                          <input type="text" name="name" value="{{ $category->name }}">
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
        <div class="row text-center">
          {{ $categories->links() }}
        </div>
    </div>
    <div class="panel panel-default col-md-4">
      <div class="panel-heading">Add Category</div>
      <div class="panel-body">
        <form class="form-inline" action="{{ route('category.store') }}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name" class="sr-only">Name: </label>
            <input type="text" name="name" placeholder="Category" class="form-control">
          </div>
          <input type="submit" value="Add" class="btn btn-success">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
