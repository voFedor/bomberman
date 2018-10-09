@extends('layouts.lobby')

@section('content')



    <!-- Start home section -->
    <div id="home">
        <!-- Start cSlider -->
        <div id="da-slider" class="da-slider">
            <div class="triangle"></div>
            <!-- mask elemet use for masking background image -->
            <div class="mask"></div>
            <!-- All slides centred in container element -->
            <div class="container">
                <!-- Start first slide -->
                <div class="da-slide">
                    <h2 class="fittext2">Победа звенит в кармане!</h2>
                    <h4>Теперь вы можете побеждать не только на словах.<br/>
                        На платформе Game Chainger <br/>
                        можно играть и зарабатывать на каждой победе.</h4>
                    <div class="da-img">
                        <img src="{{ env('THEME') }}/images/Slider01.png" alt="image01" width="320">
                    </div>
                </div>
                <!-- End first slide -->
                <!-- Start second slide -->
                <div class="da-slide">
                    <h2>Деньги, женщины, победа!</h2>
                    <h4><br/><br/>На нашей платформе есть почти все.</h4>
                    <div class="da-img">
                        <img src="{{ env('THEME') }}/images/Slider02.png" width="320" alt="image02">
                    </div>
                </div>
                <!-- End second slide -->
                <!-- Start third slide -->
                <div class="da-slide">
                    <h2>Турнир близко</h2>
                    <h4>Скоро состоиться туренир по Bomberman<Br/>
                    Призовой фонд больше 5000 рэ</h4>
                    <a href="/tournaments/" class="da-link button">Подробнее</a>
                    <div class="da-img">
                        <img src="{{ env('THEME') }}/images/Slider03.png" width="320" alt="image03">
                    </div>
                </div>
                <!-- Start third slide -->
                <!-- Start cSlide navigation arrows -->
                <div class="da-arrows">
                    <span class="da-arrows-prev"></span>
                    <span class="da-arrows-next"></span>
                </div>
                <!-- End cSlide navigation arrows -->
            </div>
        </div>
    </div>
    <!-- End home section -->
    <!-- Service section start -->
    <div class="section primary-section" id="service">
        <div class="container">
            <!-- Start title section -->
            <div class="title">
                <h1>Выигрывай и получай деньги за победу</h1>
                <!-- Section's title goes here -->
                <p>Здесь ты можешь создавать и участвовать в турнирах. <br/> А побеждая получать денежное вознаграждение.</p>
                <p>Все просто!</p>
                <!--Simple description for section goes here. -->
            </div>
            <div class="row-fluid">
                <div class="span2">
                    <div class="centered service">
                        <div class="circle-border zoom-in">
                            <img class="img-circle" src="{{ env('THEME') }}/images/Service1.png" alt="service 1">
                        </div>
                        <h3>Регистрируешься</h3>
                    </div>
                </div>
                <div class="span2">
                    <div class="centered service">
                        <div class="circle-border zoom-in">
                            <img class="img-circle" src="{{ env('THEME') }}/images/Service2.png" alt="service 2" />
                        </div>
                        <h3>Пополняешь баланс</h3>
                    </div>
                </div>
                <div class="span2">
                    <div class="centered service">
                        <div class="circle-border zoom-in">
                            <img class="img-circle" src="{{ env('THEME') }}/images/Service3.png" alt="service 3">
                        </div>
                        <h3>Выбираешь игру</h3>
                    </div>
                </div>
                <div class="span2">
                    <div class="centered service">
                        <div class="circle-border zoom-in">
                            <img class="img-circle" src="{{ env('THEME') }}/images/Service4.png" alt="service 4">
                        </div>
                        <h3>Выбираешь ставку</h3>
                    </div>
                </div>
                <div class="span2">
                    <div class="centered service">
                        <div class="circle-border zoom-in">
                            <img class="img-circle" src="{{ env('THEME') }}/images/Service5.png" alt="service 5">
                        </div>
                        <h3>Побеждаешь</h3>
                    </div>
                </div>
                <div class="span2">
                    <div class="centered service">
                        <div class="circle-border zoom-in">
                            <img class="img-circle" src="{{ env('THEME') }}/images/Service6.png" alt="service 6">
                        </div>
                        <h3>Забираешь выигрыш</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service section end -->
    <div class="section secondary-section">
        <div class="triangle"></div>
        <div class="container centered">
            <p class="large-text">Зарегистрируйся в 1 клик!</p>
            <form action="/register" method="post" class="" id="callToAction-form">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="callToActionEmail" type="email" required class="form-control" id="callToActionEmail" placeholder="Введи email">
                </div>
                <input type="hidden" name="login-with-ajax-call-to-action" value="register">
                <button onclick="return callToAction()" type="button" class="button">клик</button>
            </form>
        </div>
    </div>
    <!-- Client section start -->
    <div id="games" class="section third-section">
        <div class="container centered">
            <div class="sub-section">
                <div class="title clearfix">
                    <div class="pull-left">
                        <h3>Игры</h3>
                    </div>
                    <ul class="client-nav pull-right">
                        <li id="client-prev"></li>
                        <li id="client-next"></li>
                    </ul>
                </div>
                <ul class="row client-slider" id="clint-slider">
                    @foreach($games as $game)
                        <li>
                            <a href="javascript:void(0)" onclick="return checkBet({{Auth::check() ? Auth::user()->credits : null}}, {{ $game->id }})">
                                <img src="{{ env('THEME') }}/images/{{ $game->getLogo() }}" alt="client logo 1">
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="#" data-toggle="modal" data-target="#newGame">
                            <img src="{{ env('THEME') }}/images/games/cs-go.png" alt="client logo 1">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Contact section start -->
    <div id="contact" class="contact">
        <div class="section secondary-section">
            <div class="container">
                <div class="row">



                    <div class="col-md-12">

                        <div id="fb-root" style="width: 100%;"></div>
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v3.1&appId=134229433336489&autoLogAppEvents=1';
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-comments" data-href="http://gamechainger.io/" data-width="100%" data-numposts="15">
                        </div>

                    </div>
                            </div>
            </div>
            <div class="row">



                <div class="col-md-12">

                    <div class="title">
                        <h1>Мы на связи</h1>
                        <p>Не стесняйся, пиши все, что о нас думаешь </p>
                        <div class="span5 contact-form centered animated bounceIn" style="margin-top: 20px;margin-bottom: 20px;">
                            {{--<h3>Say Hello</h3>--}}
                            <div id="successSend" class="alert alert-success invisible">
                                <strong>Well done!</strong>Сообщение отправлено</div>
                            <div id="errorSend" class="alert alert-error invisible">Ошибка</div>
                            <form role="form" id="feedback_form" action="javascript:void(0);" method="POST">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                <div class="control-group">
                                    <div class="controls">
                                        <div class="form-group">
                                            <label for="sel1" style="color: black">Тип отзыва:</label>
                                            <select name="questionType" class="form-control" id="questionType">
                                                <option value="Отзыв">Отзыв</option>
                                                <option value="Предложение">Предложение</option>
                                                <option value="Вопрос">Вопрос</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input required class="span1 form-control" style="width: 93%;" type="text" id="name" name="name" placeholder="* Имя...">
                                        <div class="error left-align" id="err-name">Введи имя</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input required class="span1 form-control" style="width: 93%;" type="email" id="email" name="email" placeholder="* Email...">
                                        <div class="error left-align" id="err-email">Нужен настоящий email</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <textarea required class="span1 form-control" style="width: 93%;" name="comment" id="comment" placeholder="* Сообщение"></textarea>
                                        <div class="error left-align" id="err-comment">Сообщение</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button onclick="return checkFeedbackForm()" class="message-btn">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
            <div class="container">
                <div class="span9 center contact-info">
                    {{--<p>123 Fifth Avenue, 12th,Belgrade,SRB 11000</p>--}}
                    {{--<p class="info-mail">ourstudio@somemail.com</p>--}}
                    {{--<p>+11 234 567 890</p>--}}
                    {{--<p>+11 286 543 850</p>--}}
                    {{--<div class="title">--}}
                        <h3>Мы еще не очень активны в соцсетях, но все равно добавься! <br/> Скоро там будет очень интересно</h3>
                   </div>
                </div>
                <div class="row-fluid centered">
                    <ul class="social">

                        <li>
                            <a href="https://www.facebook.com/gamechainger/" target="_blank">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="icon-twitter-circled"></span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li>
                            <a href= "https://www.linkedin.com/company/gamechainger/" target="_blank">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact section edn -->

@endsection