<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', ' Spring up') }}</title>

<!--  Streets JS & CSS -->
<link rel="shortcut icon" href="/images/assets/StreetsIcon.ico" type="image/x-icon"/>
<meta name="description" content=""/>
<meta name="keywords" content=""/>


<link rel="stylesheet" type="text/css" media="all"
      href="/?css=styles/main.v.1500055270"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


<script src="/scripts/main" type="text/javascript"></script>

<!-- MOBILE -->
<link rel="stylesheet" type="text/css" media="all"
      href="/?css=styles/mediaqueries.v.1500054958"/>

<!-- Laravel JS & CSS -->

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/psc.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">


<!-- Scripts -->
{{--<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>--}} {{--@Ray Commented out because we're using CDN--}}
<script src="{{ asset('js/share.js') }}"></script>
<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
</script>