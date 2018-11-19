<meta charset=utf-8>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Играй и зарабатывай на каждой победе</title>
<meta name="description" content="Большой выбор игр, соревнйся с друзьями, участвуй в турнирах, побеждай" />
<meta name="_token" content="{!! csrf_token() !!}" />
<!-- Load Roboto font -->
<!--<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
<!-- Load css styles -->
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/bootstrap-responsive.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/style.css" />
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/pluton.css" />
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/custom.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/pluton-ie7.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/jquery.cslider.css" />
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/jquery.bxslider.css" />
<link rel="stylesheet" type="text/css" href="/{{ env('THEME') }}/css/animate.css" />
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/{{ env('THEME') }}/images/ico/apple-touch-icon-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/{{ env('THEME') }}/images/ico/apple-touch-icon-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/{{ env('THEME') }}/images/apple-touch-icon-72.png">
<link rel="apple-touch-icon-precomposed" href="/{{ env('THEME') }}/images/ico/apple-touch-icon-57.png">
<link rel="shortcut icon" href="/{{ env('THEME') }}/images/ico/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.css">


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter50597182 = new Ya.Metrika2({
                    id:50597182,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/50597182" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<link rel="canonical" href="/">
<link rel="shortlink" href="/">

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<style>
        .duel {
  background-color : #31B0D5;
  color: white;
  padding: 10px 20px;
  border-radius: 4px;
  border-color: #46b8da;
}

#mybutton {
  position: fixed;
  bottom: -4px;
  left: 10px;
}
    </style>