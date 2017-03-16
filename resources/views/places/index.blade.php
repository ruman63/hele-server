@extends('main')
@section('title', '| All Places')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">All Places</h1>
      <a href="{{ route('places.create') }}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Add New Place</a>
      <br>
      <table class="table">
        <thead>
          <th>#</th>
          <th>Name</th>
          <th>Location</th>
          <th>City</th>
          <th>Category</th>
          <th>Description</th>
          <th width="70px"></th>
        </thead>
        <tbody>
        @foreach ($places as $place)
          <tr>
            <td>{{ $place->id }}</td>
            <td>{{ $place->name }}</td>
            <td>{{ $place->location }}</td>
            <td>{{ $place->city }}</td>
            <td>{{ $place->category->name }}</td>
            <td>{{ substr($place->description, 0, 80) }}{{ strlen($place->description) > 80 ? "..." : "" }}</td>
            <td>
              <a href="{{ route('places.show', $place->id) }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list"></span></a>
              <a href="javascript: submitDelete({{ $place->id }})" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
              <form id="delete-{{$place->id}}" class="pull-right" action="{{ route('places.destroy', $place->id) }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      <div class="row text-center">
        {{ $places->links() }}
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
      function submitDelete(id) {   $("#delete-"+id).submit(); }
   </script>
@endsection
