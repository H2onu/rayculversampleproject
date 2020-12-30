<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<style>
    #imagePreview {
        width: 180px;
        height: 180px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
    }

</style>
<head>
    @include('partials.head')
</head>
<body>

@include('partials.nav')

<div id="app">
    <img src="{{ asset('assets/images/21493-6pro-PSC-FormAsset-2060x342.jpg') }}" class="img-responsive"
         style="width: 100%;padding: 0 50px;">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if(Request::segment(1) != 'administerEvent' && Request::segment(1) != 'login' )
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{--{{  $events->event_name }}--}}
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(!isset($denied))
                    <ul class="nav navbar-nav">
                        @if(Request::segment(1) != 'login')
                            <li><a href="/">Home</a></li>
                        @endif
                        @if(Request::segment(1) != 'administerEvent' && Request::segment(1) !=  '')
                            @hasanyrole('Admin|City Admin|Project Owner')

                            <li><a href="{{ URL::route('submitProject' , [Request::segment(1)]) }}">Submit Project</a>
                            </li>

                            @endhasanyrole
                            @if(Request::segment(1) != 'login' && Request::segment(1) !=  '')
                                <li><a href="{{ URL::route('volunteerProject.index' , [Request::segment(1)])}}">Volunteer
                                                                                                                For A
                                                                                                                Project</a>
                                </li>
                            @endif

                        @endif
                        @hasanyrole('Admin|City Admin')
                        @if(Request::segment(1) != 'administerEvent' && Request::segment(1) !=  '')

                            <li><a href="{{ URL::route('submitProject.shortForm' , [Request::segment(1)])}}">Short
                                                                                                             Form</a>
                            </li>
                        @endif
                        <li><a href="{{ route('administerEvent.index' , [Request::segment(1)]) }}">Administer Events</a>
                        </li>@endhasanyrole
                        {{--<li><a href="{{ route('administerProject.index') }}">Events</a></li>--}}
                        {{--<li><a href="{{ route('reports') }}">Project Reports</a></li>--}}
                    </ul>
                @endif
            <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    @role('Admin') {{-- Laravel-permission blade helper --}}
                                    <a href="/permissions"><i class="fa fa-btn fa-unlock"></i>Admin</a>
                                    @endrole
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>
    <div class="sheet">


        @yield('content')

    </div>
    @include('partials.footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>

<footer>

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#event_start_date").datepicker();
            $("#event_end_date").datepicker();
            $("#projRegFormOnDate").datepicker();
            $("#projRegFormOffDate").datepicker();
            $("#volRegFormOnDate").datepicker();
            $("#volRegFormOffDate").datepicker();
        });


        $(document).ready(function () {

            function neighborhood(value) {
                $('#neighborhood').val(value);

                alert('yah');
            }
        });


        $(function () {
            $("#uploadFile").on("change", function () {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        $("#imagePreview").show();
                        $("#imagePreview").css("background-image", "url(" + this.result + ")");
                    }
                }
            });
        });

    </script>


</footer>


</html>
