@extends('layouts.app')

@section('content')

    <div class="container">

       @can('Add Event') <span><a href="{{URL::route('administerEvent.create')}}"><button>Create Event</button></a></span>@endcan

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
                  @can('Edit Event')<td><span><a href="{{URL::route('administerEvent.edit', $event->id)}}"><button>Edit Event</button></a></span>@endcan
                    </td>
                   @can('View Event Dashboard')<td><span><a href="{{URL::route('event-dashboard',  $event->id)}}"><button>Event Dashboard</button></a></span>@endcan
                    </td>
                    @can('View Event Dashboard')<td><span><a href="{{URL::route('event-home',  $event->id)}}"><button>GO</button></a></span>@endcan
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@endsection
