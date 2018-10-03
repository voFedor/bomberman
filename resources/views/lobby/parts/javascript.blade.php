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
<script src="{{ env('THEME') }}/js/jquery.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/jquery.mixitup.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/modernizr.custom.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/jquery.cslider.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/jquery.inview.js"></script>
<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
<script src="{{ env('THEME') }}/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="{{ env('THEME') }}/js/app.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/popup-form.js"></script>
<script type="text/javascript" src="{{ env('THEME') }}/js/auth.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    function checkBet(credits, id) {

        if(credits !== 0) {

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
                        console.log(xhr);
                    }
                });


        } else {
            alert('Вам необходимо авторизоваться для того чтобы начать играть');
        }
    }

@if(Auth::user() != null)
    function pickBet(id, url, bet) {
            if ({{Auth::user()->credits}} < bet)
    {
        alert('У вас не достаточно денег');
        return;
    }

                window.open(url, info + ' BTC', 'scrollbars=no,fullscreen=no,left=0,top=0,height=800,width=800');
            
    }
    @endif
    
    function checkFeedbackForm() {

        var email = $('#email').val();
        var name = $('#name').val();
        var comment = $('#comment').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/feedback',
            type: "POST",
            dataType: "JSON",
            data: {email: email, name:name, comment:comment, _token: '{{csrf_token()}}'},
            success: function (data) {
                console.log(JSON.parse(data));
            },
            error: function (xhr, str) {
                console.log(xhr.responseText);
                toastr.clear();
                toastr.error('Произошла ошибка. Попробуйте обновить страницу и отправить сообщение еще раз', 'Ошибка!', {timeOut: 3000})
            }
        });

    }



</script>
