@extends('layouts.app')

@section('content')

    <div class="container">

        {!! Form::open(['url' => $event_id.'/submitProject', 'id' => 'submit_project', 'name' => 'submit_project']) !!}

        @if(empty($form))
            @include('project.projectform' , ['submitButtonText' => 'Add Project'])
        @elseif($form == 'shortForm')
            @include('partials.contact')
            @include('partials.projects' , ['submitButtonText' => 'Add Project'])
            {!! Form::hidden('volunteers_requested', '1' )  !!}
            {!! Form::hidden('private_property', '0' )  !!}

        @endif

        {!! Form::close() !!}


    </div>


@endsection


@if(count($errors))

    <div class="alert alert-danger">

        <ul>

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

