@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <h3> Street up Event Administration Screen</h3>

        </div>

        {!! Form::open([ 'method' => 'POST', 'url' => 'administerEvent' , 'id' => 'admin_event', 'name' => 'admin_event'])  !!}

        @include('partials.events' ,  ['submitButtonText' => 'Add Event'])


    </div>

    </div>

    {!! Form::close() !!}

    <hr>

    </div>


@endsection
