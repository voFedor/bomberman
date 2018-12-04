<!-- Yandex.Metrika counter by Yandex Metrica Plugin -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter47543785 = new Ya.Metrika({
                    id: 47543785,
                    webvisor: true,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: false,
                    trackHash: false
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/47543785" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter  -->


<!-- Include javascript -->
<script src="/{{ env('THEME') }}/js/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script type="text/javascript" src="/{{ env('THEME') }}/js/jquery.mixitup.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/bootstrap.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/modernizr.custom.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/jquery.cslider.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/jquery.inview.js"></script>


<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
<script src="{{ env('THEME') }}/js/respond.min.js"></script>
<![endif]-->

<script type="text/javascript" src="/{{ env('THEME') }}/js/app.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/popup-form.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/auth.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/custom.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>\


<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.js"></script>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>


<script>






    function checkBalance(id, bet) {
        if ("{{Auth::user()}}" == "")
        {
            $('#loginForm').modal('show');
            toastr.clear();
            toastr.error('Выполните вход на сайт', '', {timeOut: 3000});
            return;
        }



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/check-balance',
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'},
            success: function (data) {
                if (bet != 0 && data['result'] < 100)  {
                    $('#paymentBtn').modal('show');
                    toastr.clear();
                    toastr.error("", 'Пополните счет!', {timeOut: 3000})
                    return false;
                } else {
                    window.location.href = "/users-list/"+id+'/'+bet;
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

    function checkoutRegForm() {
        $("#loginFormContent").css("display", "none");
        $("#regForm").css("display", "block");
    }

    function checkoutLoginForm() {
        $("#loginFormContent").css("display", "block");
        $("#regForm").css("display", "none");
    }


    (function($){
        $.getQuery = function( query ) {
            query = query.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var expr = "[\\?&]"+query+"=([^&#]*)";
            var regex = new RegExp( expr );
            var results = regex.exec( window.location.href );
            if( results !== null ) {
                return results[1];
                return decodeURIComponent(results[1].replace(/\+/g, " "));
            } else {
                return false;
            }
        };
    })(jQuery);




    function startGameInModal(url) {
        $('#startGame').modal('show').find('.modal-body').load(url);
    }
    $('#startGame').on('show.bs.modal', function (e) {
        var loadurl = $();

    });




    function saveEmail() {
        var email = $("#exampleInputEmail1").val();
        
        if (email == null || email == ""){
            toastr.clear();
            toastr.error("Заполните поле email", 'Ошибка!', {timeOut: 3000})
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/save-email',
            type: "POST",
            data: {
                email: email,
                _token: '{{csrf_token()}}'},
            success: function (data) {
                if (data['result'] == 'error')  {
                    toastr.clear();
                    toastr.error("Что-то пошло не так", 'Ошибка!', {timeOut: 3000})
                    
                }
                if (data['result'] == 'success') {
                    toastr.clear();
                    toastr.success("Ваша почта сохранена", 'Отлично!', {timeOut: 3000});
                    $("#newUserEmail").val("");
                    
                }
                window.location.href = env('APP_URL')+"/pvp/lobby";

            },
            error: function (xhr, str) {
                return 0;
            },
            beforeSend : function (){
                toastr.clear();
                toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
            }
        });
    }






    {{--function checkBalance() {--}}

        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}
        {{--$.ajax({--}}
            {{--url: '/check-balance',--}}
            {{--type: "POST",--}}
            {{--data: {--}}
                {{--_token: '{{csrf_token()}}'},--}}
            {{--success: function (data) {--}}
                {{--if (data['result'] == 'error')  {--}}
                    {{--toastr.clear();--}}
                    {{--toastr.error(data['message'], 'Ошибка!', {timeOut: 3000})--}}
                    {{--return false;--}}
                {{--}--}}
                {{--if (data['result'] == 'success') {--}}
                    {{--toastr.clear();--}}
                    {{--toastr.success(data['message'], 'Отлично!', {timeOut: 3000})--}}
                    {{--return true;--}}
                {{--}--}}

            {{--},--}}
            {{--error: function (xhr, str) {--}}
                {{--return 0;--}}
            {{--},--}}
            {{--beforeSend : function (){--}}
                {{--toastr.clear();--}}
                {{--toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});--}}
            {{--}--}}
        {{--});--}}
    {{--}--}}

    @if(Auth::user() != null)
    function checkBalanceFromChallenge(id, bet, uuid) {
        if ("{{Auth::user()}}" == "")
        {
            $('#loginForm').modal('show');
            toastr.clear();
            toastr.error('Выполните вход на сайт', '', {timeOut: 3000});
            return;
        }



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/check-balance',
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'},
            success: function (data) {
                if (bet != 0 && data['result'] < 100)  {
                    $('#paymentBtn').modal('show');
                    toastr.clear();
                    toastr.error("", 'Пополните счет!', {timeOut: 3000})
                    return false;
                } else {
                    openMathGameWindow("{{env('GAME_HOST')}}"+"/?"+uuid+"/"+'{{Auth::user()->id}}')
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


    function getDuel(game_id) {
    

    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/pvp/get-duel',
                    type: "POST",
                    data: { game_id: game_id},
                    success: function(data){
                    window.location = "{{ env('APP_URL') }}/pvp/lobby/";
                    },
                    error:  function(xhr, str){
                    },
                    beforeSend : function (){
                        toastr.clear();
                        toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
                    }
                });
    }

    function checkBet(id) {

        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/get-bets',
                    type: "POST",
                    data: { id: id, _token: '{{csrf_token()}}'},
                    success: function(data){
                        $('#bets-modal-content').html(data);
                        $('#bets-modal').modal('show');
                    },
                    error:  function(xhr, str){
                    },
                    beforeSend : function (){
                        toastr.clear();
                        toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
                    }
                });


        }
   @else
   function checkBet(id) {
       toastr.clear();
       toastr.error('Вам необходимо авторизоваться для того чтобы начать играть', 'Ошибка!', {timeOut: 3000})
       return;
   }

   function getDuel() {
       toastr.clear();
       toastr.error('Вам необходимо авторизоваться для того чтобы начать играть', 'Ошибка!', {timeOut: 3000})
       return;
   }
    @endif


    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
            function(m,key,value) {
                vars[key] = value;
            });
        return vars;
    }
    function openMathGameWindow(data) {
        console.log(data);
        $.fancybox.open({
            padding : 0,
            src: data,
            type: 'iframe',
            scrolling : 'auto',
            preload   : true,
            wmode: 'transparent',
            allowfullscreen   : true,
            allowscriptaccess : 'always',
            buttons : ['close'],
            clickSlide: 'toggleControls',
            afterClose: function( instance, slide ) {
            }
        });
    }
    
    function openGameWindow(json) {
        $.fancybox.open({
            padding : 0,
            src: json['url'],
            type: 'iframe',
            scrolling : 'auto',
            preload   : true,
            wmode: 'transparent',
            allowfullscreen   : true,
            allowscriptaccess : 'always',
            buttons : ['close'],
            clickSlide: 'toggleControls',
            afterClose: function( instance, slide ) {
                var session_id = json['session_id'];
                var user_id = json['user_id'];
                afterCloseGameWindow(session_id, user_id);
            }
        });
    }



    function openScoreGameWindow(url) {
        $.fancybox.open({
            padding : 0,
            src: url,
            type: 'iframe',
            scrolling : 'auto',
            preload   : true,
            wmode: 'transparent',
            allowfullscreen   : true,
            allowscriptaccess : 'always',
            buttons : ['close'],
            clickSlide: 'toggleControls',
            afterClose: function( instance, slide ) {
                afterCloseGameWindow(session_id, user_id);
            }
        });
    }


    function afterCloseGameWindow(session_id, user_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/api/v1/exit?session_id='+session_id+'&user_id='+user_id,
            type: "GET",
            data: { session_id: session_id, user_id: user_id, _token: '{{csrf_token()}}'},
            success: function(data){

                if(data['result']){
                    if(data['user_id'] == user_id) {
                        console.log('close user fancy box');
                         $.fancybox.close();
                    }
                }

                @if (Auth::check() && Auth::user()->email == null)
                    $('#new_user_name').text(data['new_user_name']);
                    $('#password').text(data['password']);
                   $('#newUserForm').modal('show');
                @endif
            },
            error:  function(xhr, str){
            }
        });
    }


@if(Auth::user() != null)

function openModalAuth() {
    openPopupForm();
    toastr.clear();
    toastr.error('Выполните вход на сайт', '', {timeOut: 3000});
}


    function pickBet(id, url, bet) {
    if ({{Auth::user()->credits}} < bet)
    {
        toastr.clear();
        toastr.error('У вас не достаточно денег', 'Ошибка!', {timeOut: 3000});
        return;
    }

    $.ajax({
        url: url,
        type: "GET",
        success: function(json){
            openGameWindow(json);
        },
        error:  function(xhr, str){
            console.log(xhr);
        }
    });
    }

    @endif


    function openModalAuth() {
        openPopupForm();
        toastr.clear();
        toastr.error('Выполните вход на сайт', '', {timeOut: 3000});
    }



    function refreshStatus(duel_id) {
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/refresh-status',
                type: "POST",
                data: {
                    duel_id: duel_id,
                    _token: '{{csrf_token()}}'},
                success: function (data) {

                    if (data['result'] == 'error')  {
                        toastr.clear();
                        toastr.error(data['message'], 'Ошибка!', {timeOut: 3000})
                    }
                    if (data['result'] == 'success') {
                        $("#status_"+duel_id).text();
                        $("#status_"+duel_id).text(data['status']);

                        toastr.clear();
                        toastr.success(data['message'], 'Отлично!', {timeOut: 3000})
                    }
                    
                },
                error: function (xhr, str) {

                    toastr.clear();
                    toastr.error('Что-то пошло не так', 'Ошибка!', {timeOut: 3000});
                    var balance = 0;
                    return;
                },
                beforeSend : function (){
                    toastr.clear();
                    toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
                }
            });

        }


    function checkFeedbackForm() {

        var email = $('#email').val();
        var name = $('#name').val();
        var comment = $('#comment').val();
        var questionType = $('#questionType').val();


        if (email != "" && name != "" && comment != "") {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/feedback',
                type: "POST",
                dataType: "JSON",
                data: {email: email, name:name, comment:comment, questionType: questionType, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#email').val('');
                    $('#name').val('');
                    $('#comment').val('');
                    $('#questionType').val('');


                    if (data['result'] == 'error')  {
                        toastr.clear();
                        toastr.error(data['message'], 'Ошибка!', {timeOut: 3000})
                        return;
                    }
                    if (data['result'] == 'success') {
                        toastr.clear();
                        toastr.success(data['message'], 'Отлично!', {timeOut: 3000})
                        return;
                    }


                },
                error: function (xhr, str) {
                    $('#email').val('');
                    $('#name').val('');
                    $('#comment').val('');
                    $('#questionType').val('');


                    toastr.clear();
                    toastr.error('Произошла ошибка. Попробуйте обновить страницу и отправить сообщение еще раз', 'Ошибка!', {timeOut: 3000})
                    return;
                },
                beforeSend : function (){
                    toastr.clear();
                    toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
                }
            });

        } else {

            toastr.clear();
            toastr.error('Заполните все поля', 'Ошибка!', {timeOut: 3000})
            return;
        }
    }






    function newGameFeedback() {
        var newGame = $('#newGameCommentArea').val();

        if (newGame != null && newGame != "") {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/new-game',
                type: "POST",
                data: {newGame: newGame, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#newGameCommentArea').val("");
                    if (data['result'] == 'error')  {
                        toastr.clear();
                        toastr.error(data['message'], 'Ошибка!', {timeOut: 3000})
                    }
                    if (data['result'] == 'success') {
                        toastr.clear();
                        toastr.success("Спасибо за ваш отзыв", 'Отлично!', {timeOut: 3000})
                    }

                    $('#newGame').modal('hide');
                    return;
                },
                error: function (xhr, str) {
                    $('#newGameCommentArea').val();
                    toastr.clear();
                    toastr.error('Что-то пошло не так', 'Ошибка!', {timeOut: 3000});
                    $('#newGame').modal('hide');
                    return;
                },
                beforeSend : function (){
                    toastr.clear();
                    toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
                }
            });
        } else {
            toastr.clear();
            toastr.error('Заполните отзыв', 'Ошибка!', {timeOut: 3000})
            return;
        }




    }



    function cashOut() {
        var priceCashOut = $('#priceCashOut').val();
        var cardNumber = $('#cardNumber').val();
        var yandexWallet = $('#yandexWallet').val();
        var transactionType = $('#transactionType').val();
        var cashOutInfo;

        if (priceCashOut == "" || priceCashOut == null || priceCashOut < 2) {
            toastr.clear();
            toastr.error('Сумма не может быть меньше 2 рублей', 'Ошибка!', {timeOut: 3000})
            return;
        }
        if (transactionType == 'yandexWallet') {
            if(yandexWallet == "" || yandexWallet == null){
                toastr.clear();
                toastr.error('Укажите номер кошелька', 'Ошибка!', {timeOut: 3000})
                return;
            } else {
                cashOutInfo = "Вывод на yandex кошелек. Номер: " + yandexWallet + ' Сумма: '+priceCashOut;
            }
        }

        if (transactionType == 'cardNumber') {
            if(cardNumber == "" || cardNumber == null){
                toastr.clear();
                toastr.error('Укажите номер карты', 'Ошибка!', {timeOut: 3000})
                return;
            } else {
                cashOutInfo = "Вывод на карту. Номер: " + cardNumber+ ' Сумма: ' + priceCashOut;
            }
        }


        var balance = $("#gamer_balance").text();
        if (balance < priceCashOut) {
            toastr.clear();
            toastr.error('У вас нет такой суммы', 'Ошибка!', {timeOut: 3000})
            return;
        }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/cash-out-request',
                type: "POST",
                data: {
                    priceCashOut: priceCashOut,
                    cardNumber: cardNumber,
                    yandexWallet: yandexWallet,
                    transactionType: transactionType,
                    cashOutInfo: cashOutInfo,
                    _token: '{{csrf_token()}}'},
                success: function (data) {

                    $('#priceCashOut').val('');
                    $('#cardNumber').val('');
                    $('#yandexWallet').val('');
                    $('#transactionType').val('');

                    if (data['result'] == 'error')  {
                        toastr.clear();
                        toastr.error(data['message'], 'Ошибка!', {timeOut: 3000})
                    }
                    if (data['result'] == 'success') {
                        toastr.clear();
                        toastr.success("Спасибо за ваш отзыв", 'Отлично!', {timeOut: 3000})
                    }
                    balance = 0;
                    return;
                },
                error: function (xhr, str) {
                    $('#priceCashOut').val('');
                    $('#cardNumber').val('');
                    $('#yandexWallet').val('');
                    $('#transactionType').val('');

                    toastr.clear();
                    toastr.error('Что-то пошло не так', 'Ошибка!', {timeOut: 3000});
                    var balance = 0;
                    return;
                },
                beforeSend : function (){
                    toastr.clear();
                    toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
                }
            });


    }





    $(document).ready(function() {
        var yetVisited = localStorage['visited'];
        if (!yetVisited) {
            // open popup
            localStorage['visited'] = "yes";
            $('#betaVersionModal').modal('show');
        }
    });



    






    @if (request()->route("token") != null)


    
    
    
    // function newDuelGameOpen() {
    //     $.ajax({
    //     url: '/game-url-by-token',
    //     type: "POST",
    //     data: {token: '{{ request()->route("token") }}'},
    //     success: function(json){
    //         $.fancybox.open({
    //         padding : 0,
    //         src: json['url'],
    //         type: 'iframe',
    //         scrolling : 'auto',
    //         preload   : true,
    //         wmode: 'transparent',
    //         allowfullscreen   : true,
    //         allowscriptaccess : 'always',
    //         buttons : ['close'],
    //         clickSlide: 'toggleControls',
    //         afterClose: function( instance, slide ) {
    //             console.log(json);
    //             var session_id = json['session_id'];
    //             var user_id = json['user_id'];
    //             afterCloseGameWindow(session_id, user_id);
    //         }
    //     });
    //     },
    //     error:  function(xhr, str){
    //         console.log(xhr);
    //     }
    // });
    // }


    // newDuelGameOpen();
    @endif



    function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}


</script>


<script src="/hangout/js/index.js"></script>
