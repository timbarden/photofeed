@extends('layouts/app')

@section('content')
    <div class="main__header">
        <div>
            <h1>Photos</h1> 
            <!--<p>There are {{ count($photos ) }} photos in this gallery</p>-->
        </div>
    
        @if(!Auth::guest())
            <a class="btn btn-primary" href="/photos/create">Upload photos</a>
        @endif
    </div>

    @if(count($photos) > 0)
    <div class="gallery">

        <ul class="row row-cols-2 row-cols-sm-2 row-cols-md-5 g-3" id="lightgallery">
            @foreach ($photos as $photo)
            <li class="gallery__item col">
                <a class="gallery__item__link" href="/storage/cover_images/{{ $photo->full_image }}" data-src="/storage/cover_images/{{ $photo->full_image }}">
                    <img src="/storage/cover_images/{{ $photo->thumb_image }}" alt="{{ $photo->thumb_image }}" loading="lazy">
                    <div class="gallery__item__txt">
                        @if (!$photo->date_taken == "0")
                            <p>{{ date("M Y", $photo->date_taken) }}</p>
                        @endif
                    </div>    
                </a>
                @if(!Auth::guest())
                    @if(Auth::user()->id == $photo->user->id)
                        {!! Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'POST', 'class' => 'gallery__item__delete']) !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('x', ['class' => 'btn btn-danger']) }}
                        {!! Form::close() !!}
                    @endif
                    @if ($photo->date_taken == "0")
                        {!! Form::open(['action' => ['PhotosController@update', $photo->id], 'method' => 'PUT', 'class' => 'gallery__item__edit']) !!}
                            {{ Form::date('date_taken', $photo->date_taken) }}
                            {{ Form::submit('>', ['class' => 'gallery__item__btn btn btn-warning']) }}
                        {!! Form::close() !!}
                    @endif
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    <?php echo $photos->render(); ?>
    @else
        <p>No photos found.</p>
    @endif
@endsection