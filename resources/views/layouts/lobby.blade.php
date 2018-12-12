<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('lobby.parts.head')

</head>
<body>

<!-- Preloader -->
{{--@include('lobby.parts.preloader')--}}
<!-- /Preloader -->

<!-- Navbar -->
@include('lobby.parts.navbar')
<!-- /Navbar -->


@yield('content')
<div id="app">
    <chat-component></chat-component>
</div>


<div>
    @include('lobby.parts.chat')
</div>
{{--@include('lobby.parts.search')--}}

<!-- ScrollUp button start -->
@include('lobby.parts.scrollup')


@if(Auth::check())
<div id="mybutton">
<button class="duel" onclick="return getDuel(1)">
Решить спор БОМБЕРМЕНОМ
</button>
</div>

<input type="hidden" id="game_id_for_vue" name="game_id_for_vue">
<input type="hidden" id="bet_id_for_vue" name="bet_id_for_vue">
@endif
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 172832726, {disableButtonTooltip: "1"});
</script>

@include('lobby.parts.javascript')


@include('lobby.parts.modal')

</body>
</html>