<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('lobby.parts.meta')
    @include('lobby.parts.style')

</head>
<body>

<!-- loader -->
@include('lobby.parts.loader')
<!-- end loader -->

<!-- navbar top -->
@include('lobby.parts.navbar_top')
<!-- end navbar top -->

<!-- side nav right-->
@include('lobby.parts.site_navbar')
<!-- end side nav right-->

<!-- navbar bottom -->
@include('lobby.parts.bottom_navbar')
<!-- end navbar bottom -->

<!-- menu -->
@include('lobby.parts.menu')
<!-- end menu -->
@yield('content')


<!-- footer -->
@include('lobby.parts.footer')
<!-- end footer -->



@if(Auth::check())

    <input type="hidden" id="game_id_for_vue" name="game_id_for_vue">
    <input type="hidden" id="bet_id_for_vue" name="bet_id_for_vue">
@endif

<div id="app">
    <chat-component :bet_id="'+bet+'" :game_id="'+bet+'"></chat-component>
</div>
@include('lobby.parts.modal')

<!-- scripts -->
@include('lobby.parts.javascripts')


</body>
</html>
