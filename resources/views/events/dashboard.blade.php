<div class="container">
    <canvas id="myChart" width="100" height="100"></canvas>
</div>

@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Event: {{ $event->event_name }}</h1>
        <br>
        <hr>
        <div class="row">

            <div class="col-md-4">

                <div class="card" style="width: 20rem;">
                    <div class="card-block">
                        <h4 class="card-title">Active Projects</h4>
                        <p class="card-text">Total number of "active" projects</p>
                        <p class="card-text">
                        <h1>{{ $active_projects }}</h1></p>
                        <a href="{{ route('adminProject' , [ $event->id  , 'active' => '1' ]) }}"
                           class="btn btn-primary">Review Active Projects</a>
                        <br>
                        <br>
                        <a href="{{ route('export-projects' , [ $event->id , 'type' => 'active_projects']) }}"
                           class="btn btn-primary">Export Active Projects</a>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-block">
                        <h4 class="card-title">Pending Projects</h4>
                        <p class="card-text">Total number of "pending" projects</p>
                        <p class="card-text">
                        <h1>{{ $pending_projects }}</h1></p>
                        <a href="{{ route('adminProject' , [ $event->id , 'active' => '0']) }}"
                           class="btn btn-primary">Review Pending Projects</a>
                        <br>
                        <br>
                        <a href="{{ route('export-projects' , [ $event->id , 'type' => 'pending_projects']) }}"
                           class="btn btn-primary">Export Pending Projects</a>
                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <div class="card" style="width: 20rem;">
                    <div class="card-block">
                        <h4 class="card-title">Declined Projects</h4>
                        <p class="card-text">Total number of "declined" projects</p>
                        <p class="card-text">
                        <h1>{{ $declined_projects }}</h1></p>
                        <a href="{{ route('adminProject' , [ $event->id , 'active' => '2']) }}"
                           class="btn btn-primary">Review Denied Projects</a>
                        <br>
                        <br>
                        <a href="{{ route('export-projects' , [ $event->id , 'type' => 'denied_projects']) }}"
                           class="btn btn-primary">Export Denied Projects</a>
                    </div>
                </div>

            </div>

        </div>
        <br>
        <br>
        <hr/>
        <br>
        <div class="row">

            <div class="col-md-4">

                <div class="card" style="width: 20rem;">
                    <div class="card-block">
                        <h4 class="card-title">Total Block Captains</h4>
                        <p>The total number of block captains for "active" projects.</p>
                        <p class="card-text">
                        <h1>{{ $total_block_captains }}</h1></p>
                        <a href="{{ route('export-projects' , [ $event->id , 'type' => 'block_captains']) }}"
                           class="btn btn-primary">Export Block Captains</a>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-block">
                        <h4 class="card-title">Total Event Coordinators</h4>
                        <p class="card-text">Total number of event coordinators</p>
                        <p class="card-text">
                        <h1>{{ $total_event_coordinators }}</h1></p>
                        <a href="{{ route('export-projects' , [ $event->id , 'type' =>  'event_coordinators']) }}"
                           class="btn btn-primary">Export Event Coordinators</a>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-block">
                        <h4 class="card-title">Total Volunteers</h4>
                        <p class="card-text">
                        <h1>{{ $total_volunteers }}</h1></p>
                        <a href="{{ route('export-projects' , [ $event->id , 'type' => 'total_volunteers']) }}"
                           class="btn btn-primary">Export Total Volunteers</a>
                    </div>
                </div>

            </div>

        </div>

        <hr>

        <div><h3>Projects Requesting Specified Supplies</h3></div>
        <br>
        <div class="row">

            <div class="col-md-2">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="{{ asset('images/general/trash.png') }}" alt="Card image cap"
                         height="100px" width="100px">
                    <div class="card-block">
                        <h4 class="card-title">Bags</h4>
                        <p class="card-text">
                        <h3>Bag Inventory</h3>
                        <h1>{{ $events->bags }}</h1>
                        <h1>{{ $bags }}</h1></p>
                    </div>
                </div>

            </div>


            <div class="col-md-2">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="{{ asset('images/general/broom.png') }}" alt="Card image cap"
                         height="100" width="50">
                    <div class="card-block">
                        <h4 class="card-title">Brooms</h4>
                        <p class="card-text">
                        <h3>Brooms Inventory</h3>
                        <h1>{{ $events->brooms }}</h1></p>
                        <h1>{{ $brooms }}</h1></p>
                    </div>
                </div>

            </div>

            <div class="col-md-2">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="{{ asset('images/general/gloves.png') }}" alt="Card image cap"
                         height="100px" width="100px">
                    <div class="card-block">
                        <h4 class="card-title">Gloves</h4>
                        <p class="card-text">
                        <h3>Gloves Inventory</h3>
                        <h1>{{ $events->gloves }}</h1></p>
                        <h1>{{ $gloves }}</h1></p>
                    </div>
                </div>

            </div>

            <div class="col-md-2">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="{{ asset('images/general/rakes.png') }}" alt="Card image cap"
                         height="100px" width="100px">
                    <div class="card-block">
                        <h4 class="card-title">Rakes</h4>
                        <p class="card-text">
                        <h3>Rakes Inventory</h3>
                        <h1>{{ $events->rakes }}</h1></p>
                        <h1>{{ $rakes }}</h1></p>
                    </div>
                </div>

            </div>

            <div class="col-md-2">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="{{ asset('images/general/spade.png') }}" alt="Card image cap"
                         height="100px" width="100px">
                    <div class="card-block">
                        <h4 class="card-title">Shovels</h4>
                        <p class="card-text">
                        <h3>shovels Inventory</h3>
                        <h1>{{ $events->shovels }}</h1></p>
                        <h1>{{ $shovels }}</h1></p>
                    </div>
                </div>

            </div>

            @if(  $events->paint > 0 )
                <div class="col-md-2">
                    <div class="card" style="width: 20rem;">
                        <img class="card-img-top" src="{{ asset('images/general/paint.png') }}" alt="Card image cap"
                             height="100px" width="100px">
                        <div class="card-block">
                            <h4 class="card-title">Paint</h4>
                            <p class="card-text">
                            <h3>Paint Inventory</h3>
                            <h1>{{ $events->paint }}</h1></p>
                            <h1>{{ $paint }}</h1></p>
                        </div>
                    </div>
                </div>
            @endif


        </div>

    </div>

    <hr/>

    <div>
        <h3 class="center">Package Breakdown</h3>
        <a href="{{ route('export-projects' , [ $event->id , 'type' => 'project_packages']) }}"
           class="btn btn-primary">Export Project Packages</a>
        <table class="table table-striped">
            <thead>
            <row>
                <th></th>
                <th>Package Count</th>
                <th>Bags</th>
                <th>Brooms</th>
                <th>Gloves</th>
                <th>Rakes</th>
                <th>Shovels</th>
                @if(  $events->paint > 0 )
                    <th>Paint</th>@endif
            </row>
            </thead>
            <tbody>

            @foreach($total_supplies->tiers AS $key => $value)

                <tr>
                    <th>{{ $value->package }}</th>
                    <td>{{ $value->count }}</td>
                    <td>{{ $value->supplies->bags }}</td>
                    <td>{{ $value->supplies->brooms }}</td>
                    <td>{{ $value->supplies->gloves }}</td>
                    <td>{{ $value->supplies->rakes }}</td>
                    <td>{{ $value->supplies->shovels }}</td>
                    @if(  $events->paint > 0 )
                        <td>{{ $value->supplies->paint }}</td>@endif

                </tr>
            @endforeach

            <tr>
                <th>Allocated</th>
                <td></td>
                <td>{{ $total_supplies->total_bags }}</td>
                <td>{{ $total_supplies->total_brooms }}</td>
                <td>{{ $total_supplies->total_gloves }}</td>
                <td>{{ $total_supplies->total_rakes }}</td>
                <td>{{ $total_supplies->total_shovels }}</td>
                @if(  $events->paint > 0 )
                    <td>{{ $total_supplies->total_paint }}</td>@endif
            </tr>

            <tr>
                <th>Remaining</th>
                <td></td>
                <td>{{ ($events->bags - $total_supplies->total_bags) }}</td>
                <td>{{ ($events->brooms -$total_supplies->total_brooms) }}</td>
                <td>{{ ($events->gloves - $total_supplies->total_gloves) }}</td>
                <td>{{ ($events->rakes -$total_supplies->total_rakes) }}</td>
                <td>{{ ($events->shovels - $total_supplies->total_shovels) }}</td>
                @if(  $events->paint > 0 )
                    <td>{{ ($events->paint - $total_supplies->total_paint) }}</td>@endif
            </tr>

            </tbody>
        </table>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>


    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Total Projects Goal", "Active Projects", "Pending Projects", "Declined Projects"],
                datasets: [{
                    label: 'Total Projects Goal',
                    data: [100, 12, 19, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection