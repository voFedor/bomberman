@extends('layouts.lobby')

@section('content')



    <!-- Start home section -->
    <div class="section tour-section">
        <div class="triangle"></div>
        <div class="container" style="text-align: -webkit-center;">
            <h2 class="align-content-center">Пригласи друга - получи iPhone</h2>
            {{--<script src="http://gamechainger.io/timer/dcd07ca6a707711f788a1336417fb0dd.js"></script>--}}
        <!-- HelloTimer http://hello-site.ru/timer/ -->

            {{--<p class="hellotimercopy"><a href="http://hello-site.ru">Hello-Site.ru. Бесплатный конструктор сайтов.</a></p>--}}
            <!-- HelloTimer http://hello-site.ru/timer/ -->
            <h2 class="align-content-center">Трое самых активных получат ценные подарки на новый год</h2>
            <script type="text/javascript" src="http://yandex.st/jquery/2.0.3/jquery.min.js"></script>
            <script type="text/javascript">function get_timer_958(string_958) {var date_new_958 = string_958; var date_t_958 = new Date(date_new_958);var date_958 = new Date();var timer_958 = date_t_958 - date_958;if(date_t_958 > date_958) {var day_958 = parseInt(timer_958/(60*60*1000*24));if(day_958 < 10) {day_958 = "0" + day_958;}day_958 = day_958.toString();var hour_958 = parseInt(timer_958/(60*60*1000))%24;if(hour_958 < 10) {hour_958 = "0" + hour_958;}hour_958 = hour_958.toString();var min_958 = parseInt(timer_958/(1000*60))%60;if(min_958 < 10) {min_958 = "0" + min_958;}min_958 = min_958.toString();var sec_958 = parseInt(timer_958/1000)%60;if(sec_958 < 10) {sec_958 = "0" + sec_958;}sec_958 = sec_958.toString(); timethis_958 = day_958 + " : " + hour_958 + " : " + min_958 + " : " + sec_958;$(".timerhello_958 p.result .result-day").text(day_958);$(".timerhello_958 p.result .result-hour").text(hour_958);$(".timerhello_958 p.result .result-minute").text(min_958);$(".timerhello_958 p.result .result-second").text(sec_958);}else {$(".timerhello_958 p.result .result-day").text("00");$(".timerhello_958 p.result .result-hour").text("00");$(".timerhello_958 p.result .result-minute").text("00");$(".timerhello_958 p.result .result-second").text("00");} }function getfrominputs_958(){string_958 = "12/31/2018 22:22"; get_timer_958(string_958);setInterval(function(){get_timer_958(string_958);},1000);}$(document).ready(function(){ getfrominputs_958();});</script>
            <style type="text/css">/*второй*/.second-my{width: 260px;padding: 0px;text-align: center;}.second-my .result span.items{padding: 10px 7px;display: inline-block;margin: 0 4px 0 -5px;font-size: 20px;-webkit-border-radius:4px;-moz-border-radius: 4px; border-radius: 4px;-webkit-box-shadow: 0px 1px 1px 0px rgb(178, 176, 176);-moz-box-shadow: 0px 1px 1px 0px rgb(178, 176, 176);box-shadow: 0px 1px 1px 0px rgb(178, 176, 176);background: rgb(125,126,125); /* Old browsers */background: -moz-linear-gradient(top, rgba(125,126,125,1) 0%, rgba(14,14,14,1) 100%); /* FF3.6+ */background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(125,126,125,1)), color-stop(100%,rgba(14,14,14,1))); /* Chrome,Safari4+ */background: -webkit-linear-gradient(top, rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* Opera 11.10+ */background: -ms-linear-gradient(top, rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* IE10+ */ background: linear-gradient(to bottom, rgba(125,126,125,1) 0%,rgba(14,14,14,1) 100%); /* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#7d7e7d", endColorstr="#0e0e0e",GradientType=0 ); /* IE6-9 */color: white; font-family: "Russo One", sans-serif;min-width: 30px;letter-spacing: 2px;}.second-my .result span.dot{ margin: 0 -1px;position: relative;left: -4px;font-family: "Russo One", sans-serif;font-size: 17px;}.second-my .result {float: right;}.second-my .titles{position: relative;height: 0;right: -23px;width: 300px;}.second-my .titles span{font-size: 10px;position: relative;top: 12px;}.second-my .titles span.mm{right: 18px;}.second-my .titles span.hh{right: 40px; }.second-my .titles span.dd{right: 62px;}.second-my p.titloftimer{ font-size: 18px;margin: 0 auto;left: 10px;  position: relative; font-family: "Russo One", sans-serif;}/*ресет*/.timerhello span{margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;vertical-align: baseline; }.timerhello p{font-size: 100%;font: inherit;color: #191919;font-family: Verdana, sans-serif; font-size: 13px;margin: 0 0 10px 0;line-height: 17px;}.clearf{visibility: hidden;display: block;font-size: 0;content: " ";clear: both;height: 0; }p.hellotimercopy{display:none!important;} </style>
            <div class="second-my timerhello timerhello_958">
                <div class="second-my-content">
                    <link href="//fonts.googleapis.com/css?family=Russo+One&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
                    <p class="titloftimer" style="color: white">До подведения итогов:</p>
                    <br>
                    <p class="result">
                        <span class="result-day items">20</span>
                        <span class="dot" style="color: white">дн.&nbsp;</span>
                        <span class="result-hour items">12</span>
                        <span class="dot">:</span>
                        <span class="result-minute items">46</span>
                        <span class="dot">:</span>
                        <span class="result-second items">49</span>
                    </p>
                    <div class="clearf"></div>
                </div>
            </div>
            {{--<h2 class="align-content-center">Успей зарегистрироваться! Ну если не боишься проиграть!</h2>--}}
            {{--<img src="{{ config('app.theme') }}/images/gifts.png" style="width: 300px">--}}
            <form action="/tourReg" method="post" class="" id="tourRegForm" style="float: left;text-align: -webkit-left;margin-top: 30px;">
                <H3>Что нужно сделать:<br/>Зарегистрируйся<br/>Приглашай друга сразиться на "соточку" <br/>Чем больше играешь, тем больше шанс на победу</H3>

                {{ csrf_field() }}
                <img src="{{ config('app.theme') }}/images/gifts.png" style="width: 500px">
                    @if(Auth::user() == null)
                    <button onclick="return alert('Вам необходимо авторизироваться на сайте.')" type="button" class="tournament-button button">Принять участие</button>

                    @else

                    @endif
            </form>

            <table class="table table-tournament">

                <thead>
                <tr>
                    <th scope="col">Место</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Друзей</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($participants as $participant)
                        <th scope="row">{{$i}}</th>
                        <td>{{$participant->user->name}}</td>
                        <?php $i++; ?>
                    @endforeach
                </tr>
                </tbody>
            </table>


        </div>
    </div>





    <!-- Client section start -->
    {{--<div id="games" class="section tour-section">--}}
        {{--<div class="container centered">--}}
            {{--<div class="sub-section">--}}
                {{--<div class="title clearfix">--}}
                    {{--<div class="pull-left">--}}
                        {{--<h3>Наши игры</h3>--}}
                    {{--</div>--}}
                    {{--<ul class="client-nav pull-right">--}}
                        {{--<li id="client-prev"></li>--}}
                        {{--<li id="client-next"></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<ul class="row client-slider" id="clint-slider">--}}
                    {{--@foreach($games as $game)--}}
                        {{--<li>--}}
                            {{--<a href="javascript:void(0)" onclick="return checkBet({{Auth::check() ? Auth::user()->credits : 0}}, {{ $game->id }})">--}}
                                {{--<img src="{{ config('app.theme') }}/images/{{ $game->getLogo() }}" alt="client logo 1">--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endforeach--}}

                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- Contact section start -->
    {{--<div id="contact" class="contact">--}}
        {{--<div class="section secondary-section">--}}
            {{--<div class="container">--}}
                {{--<div class="title">--}}
                    {{--<h1>Contact Us</h1>--}}
                    {{--<p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="container">--}}
                {{--<div class="span9 center contact-info">--}}
                    {{--<p>123 Fifth Avenue, 12th,Belgrade,SRB 11000</p>--}}
                    {{--<p class="info-mail">ourstudio@somemail.com</p>--}}
                    {{--<p>+11 234 567 890</p>--}}
                    {{--<p>+11 286 543 850</p>--}}
                    {{--<div class="title">--}}
                        {{--<h3>We Are Social</h3>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row-fluid centered">--}}
                    {{--<ul class="social">--}}
                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="icon-facebook-circled"></span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="icon-twitter-circled"></span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="icon-linkedin-circled"></span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="icon-pinterest-circled"></span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="icon-dribbble-circled"></span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="icon-gplus-circled"></span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-- Contact section edn -->

@endsection