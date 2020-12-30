<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Spring up</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{--<style>--}}
    {{--html, body {--}}
    {{--background-color: #fff;--}}
    {{--color: #636b6f;--}}
    {{--font-family: 'Raleway', sans-serif;--}}
    {{--font-weight: 100;--}}
    {{--height: 100vh;--}}
    {{--margin: 0;--}}
    {{--}--}}

    {{--.full-height {--}}
    {{--height: 100vh;--}}
    {{--}--}}

    {{--.flex-center {--}}
    {{--align-items: center;--}}
    {{--display: flex;--}}
    {{--justify-content: center;--}}
    {{--}--}}

    {{--.position-ref {--}}
    {{--position: relative;--}}
    {{--}--}}

    {{--.top-right {--}}
    {{--position: absolute;--}}
    {{--right: 10px;--}}
    {{--top: 18px;--}}
    {{--}--}}

    {{--.content {--}}
    {{--text-align: center;--}}
    {{--}--}}

    {{--.title {--}}
    {{--font-size: 84px;--}}
    {{--}--}}

    {{--.links > a {--}}
    {{--color: #636b6f;--}}
    {{--padding: 0 25px;--}}
    {{--font-size: 12px;--}}
    {{--font-weight: 600;--}}
    {{--letter-spacing: .1rem;--}}
    {{--text-decoration: none;--}}
    {{--text-transform: uppercase;--}}
    {{--}--}}

    {{--.m-b-md {--}}
    {{--margin-bottom: 30px;--}}
    {{--}--}}
    {{--</style>--}}
</head>

@extends('layouts.app')
@section('content')


    <body>
    <div class="flex-center position-ref full-height">

        <div><h2>Choose Your Event</h2></div>


        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Active</th>
                </tr>
                </thead>
                <tbody>

                @foreach($events AS $event)

                    <tr>
                        <td>1</td>
                        <td><?php echo $event->id ?></td>
                        <td><?php echo $event->event_name ?></td>
                        <td><?php echo $event->event_start_date ?></td>
                        <td><?php echo $event->event_end_date ?></td>
                        <td><?php echo $event->active ?></td>
                        <td>{{ Html::image('/images/events/thumbnails/thumb-'.$event->imagePath) }}</td>
                        @can('Edit Event')
                            <td><span><a href="{{URL::route('administerEvent.edit', $event->id)}}"><button>Edit Event</button></a></span>@endcan
                            </td>
                            @can('View Event Dashboard')
                                <td><span><a href="{{URL::route('event-dashboard',  $event->id)}}"><button>Event Dashboard</button></a></span>@endcan
                                </td>
                                {{--@can('View Event Dashboard')--}}
                                    <td><span><a href="{{URL::route('event-home',  $event->id)}}"><button>GO</button></a></span>
                                        {{--@endcan--}}
                                    </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

    </div>


    </div>
    </div>
    </body>
</html>
@endsection