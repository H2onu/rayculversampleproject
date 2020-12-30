@extends('layouts.app')

@section('content')

    {{--{{dd($events)}}--}}

    <h1>Editing: {!! $events->event_name !!}</h1>

   <h1>PROJECT ID: {!! $events->id !!}</h1>

    <div class="container">

        {!! Form::model( $events , ['method' => 'PATCH' , 'files' => true ,'action' => ['adminEventController@update' , $events->id]]) !!}

        @include('partials.events' , ['submitButtonText' => 'Update Event'])


        {!! Form::close() !!}

    </div>


@stop