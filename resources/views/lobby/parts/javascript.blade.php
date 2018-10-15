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
<script>


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






    function checkBalance() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/check-balance',
            type: "POST",
            data: {
                _token: '{{csrf_token()}}'},
            success: function (data) {
                if (data['result'] == 'error')  {
                    toastr.clear();
                    toastr.error(data['message'], 'Ошибка!', {timeOut: 3000})
                    return false;
                }
                if (data['result'] == 'success') {
                    toastr.clear();
                    toastr.success(data['message'], 'Отлично!', {timeOut: 3000})
                    return true;
                }

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

    @if(Auth::user() != null)

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
    @endif


    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
            function(m,key,value) {
                vars[key] = value;
            });
        return vars;
    }
    
    
    function openGameWindow(json) {
        console.log(json['url']);
        $.fancybox.open({
            padding : 0,
            src: json['url'],
            type: 'iframe',
            scrolling : 'auto',
            preload   : true,
            wmode: 'transparent',
            allowfullscreen   : true,
            allowscriptaccess : 'always',
            buttons : [],
            clickOutside: "close",
            afterClose: function( instance, slide ) {
                var session_id = json['session_id'];
                var user_id = json['user_id'];
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
            url: '/api/v1/close?session_id='+session_id+'&user_id='+user_id,
            type: "GET",
            data: { session_id: session_id, user_id: user_id, _token: '{{csrf_token()}}'},
            success: function(data){
                console.log(data);

            },
            error:  function(xhr, str){
            }
        });
    }


@if(Auth::user() != null)

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
        }
    });
    }

    @endif


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

        var balance = checkBalance();

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
</script>
