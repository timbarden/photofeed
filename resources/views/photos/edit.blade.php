@extends('layouts/app')

@section('content')
    <h1>Edit photo timestamp</h1>
    {!! Form::open(['action' => ['PhotosController@update', $photo->id], 'method' => 'POST']) !!}
        {{ Form::hidden('_method', 'PUT') }}
            {{ Form::text('date_taken', $photo->date_taken) }}
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection 