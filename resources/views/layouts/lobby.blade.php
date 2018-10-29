<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('lobby.parts.head')
    
</head>
<body>
 <div id="app">


<!-- Navbar -->
@include('lobby.parts.navbar')
<!-- /Navbar -->


@yield('content')



{{--@include('lobby.parts.search')--}}

<!-- ScrollUp button start -->
@include('lobby.parts.scrollup')


@if(Auth::check())
<div id="mybutton">
<button class="duel" onclick="return getDuel(1)">
Назначить дуэль
</button>
</div>
@endif
 </div>

@include('lobby.parts.javascript')
@include('lobby.parts.modal')

</body>
</html>