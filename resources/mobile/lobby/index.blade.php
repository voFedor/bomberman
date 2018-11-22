@extends('layouts.lobby')

@section('content')

    <!-- slider -->
    <div class="slider">

        <ul class="slides">
            <li>
                <img src="template/mobile/{{env('MOBILE_THEME')}}/img/slide1.jpg" alt="">
                <div class="caption slider-content">
                    <h2>Победа шуршит в кармане</h2>
                    {{--<h4>можно разными методами</h4>--}}
                    {{--<button class="button-default">Read More</button>--}}
                </div>
            </li>
            <li>
                <img src="template/mobile/{{env('MOBILE_THEME')}}/img/slide2.jpg" alt="">
                <div class="caption slider-content">
                    <h2>Докажи, что ты лучший</h2>
                    {{--<h4>Lorem ipsum dolor sit amet.</h4>--}}
                    {{--<button class="button-default">Read More</button>--}}
                </div>
            </li>
            <li>
                <img src="template/mobile/{{env('MOBILE_THEME')}}/img/slide3.jpg" alt="">
                <div class="caption slider-content">
                    <h2>Решай по-взрослому</h2>
                    {{--<h4>Lorem ipsum dolor sit amet.</h4>--}}
                    {{--<button class="button-default">Read More</button>--}}
                </div>
            </li>
        </ul>

    </div>
    <!-- end slider -->

    {{--<!-- about-home -->--}}
    {{--<div class="about-home">--}}
    {{--<div class="content">--}}
    {{--<div class="container">--}}
    {{--<div class="icon">--}}
    {{--<i class="fa fa-user"></i>--}}
    {{--</div>--}}
    {{--<div class="post">--}}
    {{--<h5>About Us</h5>--}}
    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem fugit ducimus vel modi voluptates harum ducimus vel modi voluptates harum</p>--}}
    {{--<button class="button-default">Read More</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- end about-home -->--}}

    <!-- features -->
    <div class="section features bg-second">
        <div class="container">
            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <img src="template/mobile/{{env('MOBILE_THEME')}}/img/victor.png" alt="">
                        <h5>Побеждай</h5>
                        <p>И получай деньги за каждую победу</p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <img src="template/mobile/{{env('MOBILE_THEME')}}/img/tourn.png" alt="">
                        <h5>Зови друзей</h5>
                        <p>Докажи, что ты лучший</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <img src="template/mobile/{{env('MOBILE_THEME')}}/img/game.png" alt="">
                        <h5>Честная игра</h5>
                        <p>Здесь нет читов и случайностей. Только ты и твой скилл</p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <img src="template/mobile/{{env('MOBILE_THEME')}}/img/bet.png" alt="">
                        <h5>Ставь на свою победу</h5>
                        <p>Покажи всю серьезность своих намерений </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- end features -->

    <!-- quote -->
    <div class="section quote bg-second">
        <div class="container">
            <h5>Регистрируйся и в бой 👊 </h5>
            <p>Зарегистрируйся, выбери игру и отправь приглашение другу. Или недругу 😉</p>

            <a onclick="return openAuthModal()" class="side-nav-left"><button class="btn-light">Регистрация</button></a>

        </div>
    </div>
    <!-- end quote -->

    <!-- home portfolio -->
    <div class="section">
        <div class="container">
            <div class="section-head">
                <h4>История недавних побед</h4>
                <div class="underline"></div>
            </div>
            <div class="">
                <div class="row">
                    <div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/2419075213096.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;  "><p>Егор</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/241907509613123.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;"> <p>Сергей</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Soccer Stars<br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">6 окт. 2018 18-37</span>
                    </div>
                    <hr>
                    <div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/2419075096.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;  "><p>Антон</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/2234324419075096.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;"> <p>Денис</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Шашки<br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">6 окт. 2018 17-12</span>
                    </div>
                    <hr><div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/24190750961231236546.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;  "><p>Алексей</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/2419075096123123.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;"> <p>Сергей</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Шашки<br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">6 окт. 2018 16-56</span>
                    </div>
                    <hr><div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/24190750342342496.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;  "><p>Алиса</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/24190750961231236546.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;"> <p>Алексей</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Golf Battle<br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">6 окт. 2018 16-37</span>
                    </div>
                    <hr>
                    <div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/2234324419075096.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;  "><p>Денис</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/241907506546596.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;"> <p>Илья</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Шашки<br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">6 окт. 2018 11-44</span>
                    </div>
                    <hr>
                    <div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/241907506546596.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;  "><p>Илья</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/241907504234496.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;"> <p>Федор</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Soccer Stars<br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">6 окт. 2018 11-23</span>
                    </div>
                    <hr><div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/24190750961231236546.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;  "><p>Алексей</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/2419075096.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;"> <p>Антон</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Шашки<br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">5 окт. 2018 22-15</span>
                    </div>
                    <hr><div>
                        <div style="display: -webkit-inline-box;">
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/2419075096123123.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #1d8528; border-radius: 50px;  "><p>Сергей</p></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/sword.png" alt="" style="float:left;width: 30px; padding-top: 25px"></div>
                            <div class=""><img src="template/mobile/{{env('MOBILE_THEME')}}/img/users/24190750963412.jpg" alt=""  style="float:left;width: 100px; border: 3px solid #850018; border-radius: 50px;"> <p>Сергей</p></div>
                        </div>
                        <div style="float: right;margin-right: 10px;margin-top: 20px;font-size: 13px;">Игра: Football Strk <br/>Ставка: 100р</div>
                        <span style="margin-left: 23px;font-size: 18px;">5 окт. 2018 21-44</span>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!-- end home portfolio -->

@endsection
