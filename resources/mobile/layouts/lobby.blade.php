<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('lobby.parts.meta')
    @include('lobby.parts.style')

    @if(Auth::user() != null && Request::is('/'))
        <script id="chatBroEmbedCode">
            /* Chatbro Widget Embed Code Start */
            function ChatbroLoader(chats,async){async=!1!==async;var params={embedChatsParameters:chats instanceof Array?chats:[chats],lang:navigator.language||navigator.userLanguage,needLoadCode:'undefined'==typeof Chatbro,embedParamsVersion:localStorage.embedParamsVersion,chatbroScriptVersion:localStorage.chatbroScriptVersion},xhr=new XMLHttpRequest;xhr.withCredentials=!0,xhr.onload=function(){eval(xhr.responseText)},xhr.onerror=function(){console.error('Chatbro loading error')},xhr.open('GET','//www.chatbro.com/embed.js?'+btoa(unescape(encodeURIComponent(JSON.stringify(params)))),async),xhr.send()}
            /* Chatbro Widget Embed Code End */
            ChatbroLoader({

                encodedChatId: '42bgw',
                siteDomain: 'gamechainger.io',
                siteUserExternalId: "{{Auth::user()->id}}",
                siteUserFullName: "{{Auth::user()->name}}",
                signature: "{{$hash}}"
            });
        </script>

    @endif
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


@include('lobby.parts.modal')

<!-- scripts -->
@include('lobby.parts.javascripts')


</body>
</html>
