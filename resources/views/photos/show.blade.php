@extends('layouts/app')

@section('content')
    <a href="/photos">Go back</a>
    <img class="main__img" src="/storage/cover_images/{{ $photo->full_image }}" alt="{{ $photo->full_image }}">
@endsection