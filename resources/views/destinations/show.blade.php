@extends('main')
@section('title', '| '. htmlspecialchars($place->name))
@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
    <div class="row head">
      <div class="col-xs-12">
        <h1>{{ $place->name }}</h1>
        <h3><strong>Location: </strong>{{ $place->location }}</h3>
        <h3><strong>Category: </strong>{{ $place->category->name }}</h3>
        <h3><strong>Nearest Station: </strong>{{ $place->nearest_to }}</h4>
      </div>
    </div>
    @if( $place->photos()->count() > 0)
      <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading h2">Photos</div>
              <div class="panel-body">
                <div class="row">
                  @if($place->photos()->count() > 6)
                    @for ($i=0; $i < $place->photos()->count(); $i++)
                        <a href="{{ route('photos.show', $place->photos[$i]->id) }}" ><img class="image-showcase" src="{{ asset( 'images/' . $place->photos[$i]->name ) }}" width="150px"></a>
                    @endfor
                    <a href="{{ route('photos.showplace', $place->id) }}"></a>
                  @else
                    @foreach ($place->photos as $photo)
                        <a href="{{ route('photos.show', $photo->id) }}" ><img class="image-showcase" src="{{ asset( 'images/' . $photo->name ) }}" width="150px"></a>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
      </div>
    @endif

    <div class="row">
      <div class="col-xs-12">
        <p class="lead"> {{ $place->description }} </p>
        <hr>
        @foreach ($place->tags as $tag)
          <span class="label label-default">{{ $tag->name }}</span>
        @endforeach
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if($place->reviews->count() > 0)
          <div class="title-reviews">
            <h3><span class="glyphicon glyphicon-star"></span> {{ $place->reviews->count() }} Reviews</h3>
            <h3>Avearage Rating: {{ round($place->reviews()->avg('rating'), 2, PHP_ROUND_HALF_EVEN) }}</h3>
          </div>
        @endif
        @foreach($place->reviews as $review)
          <div class="review">
            <div class="review-head">
              <img src={{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($review->email))) . '?s=50&d=monsterid' }} class="review-author-img">
              <div class="review-head-text">
                <h4>{{ $review->name }} <small>({{ $review->email }})</small></h4>
                <p>{{ date('D F j, Y g:i a', strtotime($review->created_at)) }}</p>
              </div>
            </div>
            <div class="rating pull-right">
              @for ($i=0; $i < $review->rating ; $i++)
                <span class="glyphicon glyphicon-star"></span>
              @endfor
            </div>
            <div class="review-body">
              <p>{{ $review->comment }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
  <!--Reviews -->
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div id="review-form" class="review">
        <h4>Give Review</h4>
        {!! Form::open(['route' => ['reviews.store', $place->id], 'method' => 'POST']) !!}
          <div class="row">
            <div class="col-md-6">
              {{ Form::label('name', 'Name:') }}
              {{ Form::text('name', null, ['class' => 'form-control input-sm']) }}
            </div>
            <div class="col-md-6">
              {{ Form::label('email', 'Email:') }}
              {{ Form::email('email', null, ['class' => 'form-control input-sm']) }}
            </div>
            <div class="col-md-6">
              {{ Form::label('rating', 'Rating:') }}
              {{ Form::select('rating', ['1' => '1 Star','2' => '2 Star','3' => '3 Star','4' => '4 Star','5' => '5 Star'], null ,['class' => 'form-control input-sm']) }}
            </div>
            <div class="col-md-12">
              {{ Form::label('comment', 'Comment:') }}
              {{ Form::textarea('comment', null, ['class' => 'form-control input-sm', 'rows' => '4']) }}
            </div>
          </div>
          {{ Form::submit('Post Review', ['class' => 'btn btn-success btn-h1-spacing btn-sm']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
