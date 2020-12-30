@extends('layouts.app')

<!-- Update your html tag to include the itemscope and itemtype attributes. -->
<html itemscope itemtype="http://schema.org/Article">

<!-- Place this data between the <head> tags of your website -->
<title>{{ $event->event_name }}</title>
<meta name="description" content="{{ $event->description }}"/>

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $event->event_name }}">
<meta itemprop="description" content="{{ $event->event_description }}">
<meta itemprop="image" content="{{ Html::image('/images/events/thumbnails/thumb-'.$event->imagePath)}}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="{{ Html::image('/images/events/thumbnails/thumb-'.$event->imagePath)}}">
{{--<meta name="twitter:site" content="@publisher_handle">--}}
<meta name="twitter:title" content="{{ $event->event_name }}">
<meta name="twitter:description" content="{{ $event->event_description }}">
<meta name="twitter:creator" content="@Streets">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="{{ Html::image('/images/events/thumbnails/thumb-'.$event->imagePath)}}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $event->event_name }}"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="http://www..com/-spring-up/"/>
<meta property="og:image" content="{{ Html::image('/images/events/thumbnails/thumb-'.$event->imagePath)}}"/>
<meta property="og:description" content="{{ $event->event_description }}"/>
<meta property="og:site_name" content="Site Name, i.e. Moz"/>
{{--<meta property="article:published_time" content="2013-09-17T05:59:00+01:00" />--}}
{{--<meta property="article:modified_time" content="2013-09-16T19:08:47+01:00" />--}}
<meta property="article:section" content="Article Section"/>
{{--<meta property="article:tag" content="Article Tag"/>--}}
{{--<meta property="fb:admins" content="Facebook numberic ID"/>--}}



@section('content')
    <div class="container">

        <div class="center">
            <h1>Congratulations on succesfully adding a project to {{ $event->event_name }}</h1>

            <p>Now it's time to start raising awareness and get those volunteers out to help get  !
                <br>
               The best way to let people know about your project is by posting it up on your social media.
                <br>
               Click on some social media links below to start getting the word out! </p>

            {!! $social !!}

        </div>
    </div>

@endsection
