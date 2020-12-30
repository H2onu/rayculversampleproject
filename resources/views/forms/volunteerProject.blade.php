@extends('layouts.app')

@section('content')

    <div class="container">

		<?php
		$user_id = Auth::user()->id;
		$event_id = Request::segment( 1 );

		?>

        <div class="row">

            <span>Find your location below and then click "Volunteer For This Event" to register.</span>

            <br>
            <hr>

            @hasanyrole('Admin|City Admin|Project Owner')
            <span><a href="{{URL::route('my-projects', ['event_id' => $event_id , 'user_id' => $user_id])}}"><button>My Projects</button></a></span>@endhasanyrole
            <span><a href="{{URL::route('volunteerProject.index' , ['event_id' => $event_id , 'user_id' => 'null'])}}"><button>All Projects</button></a></span>

            <div style="display: inline-block; margin-left: 28%;">

                <img src="{{ asset('assets/images/21493-6pro-PSC-FormAsset-1000x1000-Black.jpg') }}" height="100px"
                     width="100px"> <a href="{{ asset('assets/images/21493-6pro-PSC-FormAsset-1000x1000-Black.jpg') }}"
                                       download="assets/images/21493-6pro-PSC-FormAsset-1000x1000-Black.jpg">
                    <button>Download Black & White PSC Logo</button>
                </a>
                <img src="{{ asset('assets/images/21493-6pro-PSC-FormAsset-1000x1000-Blue.jpg') }}" height="100px"
                     width="100px"> <a href="{{ asset('assets/images/21493-6pro-PSC-FormAsset-1000x1000-Blue.jpg') }}"
                                       download="assets/images/21493-6pro-PSC-FormAsset-1000x1000-Blue.jpg">
                    <button>Download Color PSC Logo</button>
                </a>

            </div>

            <span><h3>{{ $filter_name }}</h3></span>

            <div style="display: inline-block;">
                <hr>

                {!! Form::open([ 'id' => 'neighborhood-sort' , 'name'=> 'neighborhood-sort' , 'route' => ['neighborhood2' , $event_id, 'hood' => $neighborhood_id ]]) !!}

                {!! Form::label('sortByNeighborhood', 'neighborhood', ['class' => 'control-label']) !!}
                <br>
                {!! Form::select('neighborhood', $neighborhood, null, ['id' => 'neighborhood' , 'onchange' => 'get_url(this.value);'] ) !!}

                {!! Form::close()   !!}

            </div>

             <form class="typeahead" role="search" style="display: inline-block; margin-left: 100px;">
                <div class="form-group">
                    <input type="search" name="q" class="form-control search-input" placeholder="Search Projects" autocomplete="off">
                </div>
            </form>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins  and Typeahead) -->
        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
        <!-- Bootstrap JS -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <!-- Typeahead.js Bundle -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
            <!-- Typeahead Initialization -->
            <script>
                jQuery(document).ready(function($) {
                    // Set the Options for "Bloodhound" suggestion engine
                    var engine = new Bloodhound({
                        remote: {
                            url: '/find?q=%QUERY%',
                            wildcard: '%QUERY%'
                        },
                        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                    });

                    $(".search-input").typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1
                    }, {
                        source: engine.ttAdapter(),

                        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                        name: 'usersList',
                        displayKey: 'value',

                        // the key from the array we want to display (name,id,email,etc...)
                        templates: {
                            empty: [
                                '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                            ],
                            header: [
                                '<div class="list-group search-results-dropdown">'
                            ],
                            suggestion: function (data) {
                                return '<a href="/'+ data.event_id +'/volunteerProject/' + data.id + '" class="list-group-item">' + data.project_title +'</a>'
                            }
                        }
                    });
                });
            </script>

        </div>

        <br>
        <div class="container sp_60_width">
            @foreach($projects as $k => $v)
                {{--{{ $k }}--}}
                @foreach ($v as $key => $value)

                    {{--{{ $key . ' => ' . $value }}--}}
					<?php
					$project_id = $v->id;
					$project_name = $v->project_title;
					$neighborhood = $v->neighborhood;
					$commGroupName = $v->comm_cdc_group_name;
					$volsRequested = $v->volunteers_requested;
					$volsRegistered = $v->volunteers_registered;
					$availableSlots = $v->available_slots;
					$projLocName = $v->proj_loc_name;
					$projLocAdd = $v->proj_loc_street_address;
					$projLocZip = $v->proj_loc_zip;
					$image = $v->imagePath;
					if ( isset( $v->volactive ) ) {
						$projVolActive = $v->volactive;
					} else {
						$projVolActive = '0';
					}

					?>
                @endforeach

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3 id="sp_proj_name">Project Name: <?php echo $project_name;?></h3>
                        <h4 id="sp_location_h4"><?php echo $neighborhood;?></h4>
                        <div>Community Group Name<?php echo $commGroupName;?></div>
                    </div>
                    <div class="panel-body sp_project_panel">
                        <div class="row">
                            <div class="col-md-9 col-sm-4 col-xs-4">
                                <div class="well">
                                    <table class="table">
                                        <h2 class="center">Volunteers</h2>
                                        <tr>
                                            <th> Requested</th>
                                            <th> Registered</th>
                                            <th> Available Slots</th>
                                        </tr>
                                        <tr>
                                            <td>
												<?php echo $volsRequested;?>
                                            </td>
                                            <td>
												<?php echo $volsRegistered;?>
                                            </td>
                                            <td>
                                                @if($availableSlots > 0)
                                                    <span class="green"><?php echo $availableSlots;?></span>
                                                @else($availableSlots <= 0)
                                                    <span class="red"><?php echo $availableSlots;?></span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Project Location Street Address</h3>
                                    </div>
                                    <div class="panel-body"><?php echo $projLocAdd . ' , ' . $projLocZip;?></div>
                                    <br>
                                </div>
                            </div>


                            <div class="col-md-3 col-sm-4 col-xs-4 col_with_buttons">

                                @if(!empty($image))
                                    {{ Form::image('images/project/thumbnails/thumb-'.$image) }}
                                @endif

								<?php

								if( isset( $projVolActive ) && $projVolActive != '1' ){
								?>
                                @if($availableSlots > 0)
                                    <span><a href="{{URL::route('volunteerProject.edit',[$event_id ,  $v->id ])}}"><button>Sign Me Up</button></a></span>
                                @endif
								<?php

								}

								if( isset( $projVolActive ) && $projVolActive == '1' ){

								?>

                                <span><img src="{{asset('assets/images/tick1.png')}}" height="50" width="50"> </span>

                                <span>{{ Form::open(['route' => ['volunteerProject.destroy', $event_id , $v->id ], 'method' => 'delete']) }}
                                    <button type="submit">Unregister</button>
                                    {{ Form::close() }}
                        </span>

                                {{--<span><a href="{{URL::route('volunteerProject.destroy', $v->id)}}"><button>Unregister</button></a></span>--}}

								<?php }
								?>


                                @if($events->voucherOn == '1')

                                    @if(Auth::user()->id == $v->account_owner_id)

                                        <span><a href="{{URL::route( 'volunteerProject.voucher' , $project_id )}}"><button>Print Voucher</button></a></span>


                                    @else

                                        @hasanyrole('Admin|City Admin')

                                        <span><a href="{{URL::route( 'volunteerProject.voucher' , $project_id )}}"><button>Print Voucher</button></a></span>

                                        @endhasanyrole

                                    @endif
                                @endif

                                @if(Auth::user()->id == $v->account_owner_id)

                                    <span><a href="{{URL::route( 'my-volunteers' , [$event_id , $project_id] )}}"><button>My Volunteers</button></a></span>

                                @else

                                    @hasanyrole('Admin|City Admin')

                                    <span><a href="{{URL::route( 'my-volunteers' , [$event_id , $project_id] )}}"><button>My Volunteers</button></a></span>

                                    @endhasanyrole

                                @endif


                                @if(Auth::user()->id == $v->account_owner_id)

                                    <span><a href="{{ URL::route('projectEdit' , [$event_id , $project_id] ) }}"><button>Edit</button></a></span>

                                @else

                                    @hasanyrole('Admin|City Admin')

                                    <span><a href={{ URL::route('projectEdit' , [$event_id , $project_id] ) }}><button>Edit</button></a></span>

                                    @endhasanyrole

                                @endif

                                {!! $events->social !!}

                            </div>

                        </div>

                    </div>
                </div>


            @endforeach


            <div class="center">

                {{ $projects->links() }}

            </div>

        </div><!-- /.sp_60_width -->


        <div class="container sp_40_width">

            <div>
                {{--***MAP VIEW***--}}
                <div style="width: 100%; height: 500px;">

                    {!!  Mapper::render() !!}

                </div>
                <br>

                {{--{!! Form::label('totNumVolunteers', 'Total Number Of Volunteers Requested', ['class' => 'control-label']) !!}--}}
                {{--<span>Please key in the total number of volunteers. This includes yourelf and any volunteers you can identify at the time of this form.<br>--}}
                {{--This form only accepts numerical values.</span>--}}
                {{--<br>--}}

                {{--{!! Form::text('totNumVolunteers', 'Total Number Of Volunteers', ['class' => 'form-control'])  !!}--}}


            </div>

        </div><!-- /.sp_40_width -->

    </div>

@endsection



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>


    function get_neighborhood(value) {

        var neighborhood = $("#neighborhood option:selected").text();

        $('#neighborhood-sort').submit();

    }

    function get_url() {

        var url = $("#neighborhood-sort").attr('action');

        url = remove_segment(url);

        var cat = url += '/' + $("#neighborhood option:selected").val();

        $("#neighborhood-sort").attr('action', cat);

         get_neighborhood();
    }

    function remove_segment(url) {

        var the_arr = url.split('/');
        var lastSegment = the_arr.pop() || the_arr.pop();

        if(isNaN(lastSegment)){

            return ( url );
        }

        else{

            return ( the_arr.join('/') );
        }

    }


</script>

