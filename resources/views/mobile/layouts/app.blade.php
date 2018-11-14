<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('mobile.layouts.meta')
    @include('mobile.layouts.style')

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
@include('mobile.layouts.loader')
<!-- end loader -->

<!-- navbar top -->
@include('mobile.layouts.navbar_top')
<!-- end navbar top -->

<!-- side nav right-->
@include('mobile.layouts.site_navbar')
<!-- end side nav right-->

<!-- navbar bottom -->
@include('mobile.layouts.bottom_navbar')
<!-- end navbar bottom -->

<!-- menu -->
@include('mobile.layouts.menu')
<!-- end menu -->
@yield('content')


<!-- footer -->
@include('mobile.layouts.footer')
<!-- end footer -->


@include('mobile.layouts.modal')

<!-- scripts -->
@include('mobile.layouts.javascripts')

<script>
    function preview(token){
        $.getJSON("//ulogin.ru/token.php?host=" + encodeURIComponent(location.toString()) + "&token=" + token + "&callback=?", function(data){
            data = $.parseJSON(data.toString());
            if(!data.error){
                alert("Привет, "+data.first_name+" "+data.last_name+"!");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/ulogin',
                    type: "POST",
                    data: {
                        data: data,
                        id: id,
                        _token: '{{csrf_token()}}'},
                    success: function (data) {
                        console.log(data);
                        if (data['result'] != "success")  {
                            toastr.clear();
                            toastr.error("", 'Пополните счет!', {timeOut: 3000})
                            return false;
                        } else {
                            toastr.clear();
                            toastr.success("Приятной игры", '', {timeOut: 3000})
                            return false;
                        }
                    },
                    error: function (xhr, str) {
                        return 0;
                    },
                    beforeSend : function (){
                        toastr.clear();
                        toastr.info('Запрос обрабатывается', '', {timeOut: 3000});
                    }
                });
            }


        });
    }
</script>
</body>
</html>
