<style>

    td.collapse.in {
        display: table-cell !important;
    }


</style>

@extends('layouts.app')


@section('content')

    <div class="container">

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Administer Projects</div>
            <div class="panel-body">
                <p>This section lists <strong>@if (session('view')){{ session('view') }}@else{{ $view }}@endif</strong>
                   projects. Use this section to deactivate a project.</p>
            </div>

            <!-- Table -->
            <table class="table">

                <tr>
                    <th>Project Title</th>
                    <th>Active</th>
                    <th>Neighborhood</th>
                    <th>Project Address</th>
                    <th>Date Registered</th>
                    <th>Volunteers Requested</th>
                    <th>Community/CDC Group?</th>
                    <th>Community/CDC Group Name</th>
                    <th>Project Description</th>
                    <th>Activate Project</th>
                    <th>Decline Project</th>
                    <th>Edit Project</th>
                </tr>

                @foreach($projects AS $project)

                    <tr>
                        <td>{{ $project->project_title }}</td>
                        <td>{{ $project->active }}</td>
                        <td>{{ $project->neighborhood }}</td>
                        <td>{{ $project->proj_loc_street_address }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->volunteers_requested }}</td>
                        <td>@if($project->comm_cdc_group == 'no'){{ "no" }}
                            @elseif($project->comm_cdc_group == '0'){{ "no" }}
                            @elseif($project->comm_cdc_group == '1'){{ "yes" }}
                            @elseif($project->comm_cdc_group == "yes"){{ "yes" }}
                            @endif
                        </td>
                        <td>{{ $project->comm_cdc_group_name }}</td>
                        <td>{{ $project->proj_description }}</td>
                        <td>
                            <a href="/submitProject/activate/{{$project->id}}">
                                <button type="button" class="btn btn-default btn-lg" aria-label="glyphicon ok">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                </button>
                            </a></td>
                        <td>
                            <button data-toggle="collapse" data-target="#demo{{$project->id}}"
                                    class="btn btn-default btn-lg" aria-label="glyphicon remove">
                                <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                            </button>
                        </td>

                        <td><a href="{{ URL::route('projectEdit' , [$project->event_id , $project->id]) }}">
                                <button type="button" class="btn btn-default btn-lg" aria-label="glyphicon pencil">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                            </a>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="12" id="demo{{$project->id}}" class="collapse" style="width: 100%;">
                            Reason for project rejection....

                            {!! Form::model( $project , ['id' => 'reject_project' , 'method' => 'POST' , 'files' => true , 'action' => ['submitProjectController@decline' , 'id' =>  $project->id ] ]) !!}

                            {!! Form::textarea('rejection_reason', null, ['class' => 'form-control' , 'placeholder' => 'Reason for declination' , 'maxlength' => '200', 'rows' => '3' , 'required' => 'required']) !!}

                            {{--<a href="/submitProject/decline/{{$project->id}}">--}}
                                <button type="submit" class="btn btn-default btn-lg">
                                    Reject
                                </button>
                            {{--</a>--}}

                            {!! Form::close() !!}

                        </td>
                    </tr>

                @endforeach

            </table>
        </div>
    </div>

@endsection
