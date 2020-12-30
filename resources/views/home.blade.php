@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="center">
                            <h1>What's New</h1>
                        </div>
                    </div>

                    <div class="panel-body">
                         @include('partials.homedash')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
