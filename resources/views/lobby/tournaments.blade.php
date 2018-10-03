@extends('layouts.lobby')

@section('content')



    <!-- Start home section -->
    <div class="section tour-section">
        <div class="triangle"></div>
        <div class="container">
            <h2 class="align-content-center">До турнира по БОМБЕРМЕН осталось не так много времени </h2>
            <script src="http://megatimer.ru/s/c9d0b70bd70d4d488eb61415a9a9004b.js"></script>
            <h2 class="align-content-center">призовой фонд больше 5000рэ</h2>
            <h2 class="align-content-center">Успей зарегистрироваться! Ну если не боишься проиграть!</h2>
            <form action="/register" method="post" class="" id="callToAction-form">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="callToActionEmail" type="email" required class="form-control" id="callToActionEmail" placeholder="Введи email">
                </div>
                <input type="hidden" name="login-with-ajax-call-to-action" value="register">
                <button onclick="return callToAction()" type="button" class="button">Зарегистрироваться</button>
            </form>
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
                                {{--<img src="{{ env('THEME') }}/images/{{ $game->getLogo() }}" alt="client logo 1">--}}
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