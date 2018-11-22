<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/materialize.min.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/owl.carousel.min.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/fakeLoader.min.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/animatedModal.min.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/jquery.filterizr.min.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/jquery.magnific-popup.min.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/portfolio.js"></script>
<script src="/template/mobile/{{env('MOBILE_THEME')}}/js/main.js"></script>

<script type="text/javascript">
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="//ulogin.ru/js/ulogin.js"></script>
<script type="text/javascript" src="/{{ env('THEME') }}/js/auth.js"></script>


<script type="text/javascript" >
    
    
    function openAuthModal() {
        $('#loginForm').modal('show');
    }

    @if(Auth::user())

    function modalAuth() {
        var loginForm_email = $('#loginForm_email').val();
        var loginForm_password = $('#loginForm_password').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/modalAuth',
            type: "POST",
            data: {
                loginForm_email: loginForm_email,
                loginForm_password$: loginForm_password,
                _token: '{{csrf_token()}}'},
            success: function (data) {
            if (data['result'] == "success")  {
                toastr.clear();
                toastr.success("", 'Вход выполнен!', {timeOut: 3000});
                return true;
            } else {
                toastr.clear();
                toastr.error("Что-то не так", '', {timeOut: 3000})
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



    function generate_code(slug) {
        var uuid = Math.random().toString(36).substring(7);
        $('#social_btn_url').attr("data-url", "{{ env('APP_URL')}}/game/"+slug+"/"+uuid);
        $('#social_btn_url').attr("data-title", "{{Auth::user()->first_name}} {{Auth::user()->last_name}} вызвал вас на дуэль");
        $("#social_btn").show();
        $("#generate_ui").remove();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/generateGameUrl',
            type: "POST",
            data: {
                slug: slug,
                _token: '{{csrf_token()}}'}
        });

    }

    function invaiteFriend(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/inviteFriend',
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'}
        });
    }

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
                id: null,
                _token: '{{csrf_token()}}'},
            success: function (data) {
                if (data['result'] < 100) {
                    toastr.clear();
                    toastr.error('У вас нет такой суммы', '', {timeOut: 3000})
                    return false;
                } else {
                    toastr.clear();
                    toastr.success('Приятной игры', '', {timeOut: 3000})
                    return balance;
                }



            },
            error: function (xhr, str) {
                return 0;
            }
        });
    }


    @else

     function openModalAuth() {
        $('#get_side_bar').click();
        toastr.clear();
        toastr.error('Выполните вход на сайт', '', {timeOut: 3000});
    }
    function checkBalance() {

        toastr.clear();
        toastr.error('Выполните вход на сайт', '', {timeOut: 3000})
        return;
    }

    function checkBet(id) {
        toastr.clear();
        toastr.error('Выполните вход на сайт', '', {timeOut: 3000})
        return;
    }
    function invaiteFriend() {
        toastr.clear();
        toastr.error('Выполните вход на сайт', '', {timeOut: 3000})
        return;
    }
    function getInvitation() {

        toastr.clear();
        toastr.error('Выполните вход на сайт', '', {timeOut: 3000})
        return;
    }

    
    function checkoutRegForm() {
            $("#loginFormContent").css("display", "none");
            $("#regForm").css("display", "block");
    }

    function checkoutLoginForm() {
        $("#loginFormContent").css("display", "block");
        $("#regForm").css("display", "none");
    }

    @endif

</script>
<script>




    function cashOut() {
        var priceCashOut = $('#priceCashOut').val();
        var cardNumber = $('#cardNumber').val();
        var yandexWallet = $('#yandexWallet').val();
        var transactionType = $('#transactionType').val();
        var cashOutInfo;

        if (priceCashOut == "" || priceCashOut == null || priceCashOut < 2) {
            toastr.clear();
            toastr.error('Сумма не может быть меньше 2 рублей', '', {timeOut: 3000})
            return false;
        }
        if (transactionType == 'yandexWallet') {
            if(yandexWallet == "" || yandexWallet == null){
                toastr.clear();
                toastr.error('Укажите номер кошелька', 'Ошибка!', {timeOut: 3000})
                return false;
            } else {
                cashOutInfo = "Вывод на yandex кошелек. Номер: " + yandexWallet + ' Сумма: '+priceCashOut;
            }
        }

        if (transactionType == 'cardNumber') {
            if(cardNumber == "" || cardNumber == null){
                toastr.clear();
                toastr.error('Укажите номер карты', 'Ошибка!', {timeOut: 3000})
                return false;
            } else {
                cashOutInfo = "Вывод на карту. Номер: " + cardNumber+ ' Сумма: ' + priceCashOut;
            }
        }


        var balance = $("#gamer_balance").text();
        console.log(balance);

        if (balance < priceCashOut) {
            toastr.clear();
            toastr.error('У вас нет такой суммы', 'Ошибка!', {timeOut: 3000})
            return false;
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
                    toastr.error(data['message'], 'Ошибка!', {timeOut: 3000});
                    return false;
                }
                if (data['result'] == 'success') {
                    toastr.clear();
                    toastr.success("Деньги скоро поступят на Ваш счет", 'Отлично!', {timeOut: 3000})
                }
                balance = 0;
                return false;
            },
            error: function (xhr, str) {
                $('#priceCashOut').val('');
                $('#cardNumber').val('');
                $('#yandexWallet').val('');
                $('#transactionType').val('');

                toastr.clear();
                toastr.error('Что-то пошло не так', 'Ошибка!', {timeOut: 3000});
                var balance = 0;
                return false;
            }
        });


    }
</script>