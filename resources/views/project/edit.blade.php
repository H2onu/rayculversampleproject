@extends('layouts.app')

@section('content')

    <h1>Edit {!! $project->project_title !!}</h1>

    <h1>PROJECT ID: {!! $project->id !!}</h1>

    <div class="container">

        {!! Form::model( $project , ['id' => 'submit_project' , 'method' => 'PATCH' , 'files' => true , 'action' => ['submitProjectController@update' , $event_id ,  $project->id , $project->active ] ]) !!}

        @if($project->active == 2)
        @include('project.projectform' , ['submitButtonText' => 'Re-submit Project'])
        @else
        @include('project.projectform' , ['submitButtonText' => 'Update Project'])
        @endif

        {!! Form::close() !!}

    </div>


@stop

@if(count($errors))

    <div class="alert alert-danger">

        <ul>

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif