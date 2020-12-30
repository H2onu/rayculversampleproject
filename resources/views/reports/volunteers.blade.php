@extends('layouts.app')


@section('content')

    {{--{{ dd($project) }}--}}


    <div class="container">
        <h2>{{ $project->project_title }} Volunteers</h2>
        <p>A list of all volunteers for this project</p>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered On</th>
                <th>Active</th>
            </tr>
            </thead>

            @foreach($volunteers AS $value)

                <tr>
                    <td>{{ $value->name  }}</td>
                    <td>{{ $value->email  }}</td>
                    <td>{{ $value->vCreated_at  }}</td>
                    <td>{{ $value->active }}</td>
                </tr>

            @endforeach


        </table>
    </div>

    <div id="vgraph">

        <canvas id="graph"></canvas>


    </div>



@endsection