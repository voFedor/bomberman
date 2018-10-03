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
                    <h2 class="fittext2">Welcome to pluton theme</h2>
                    <h4>Clean & responsive</h4>
                    <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.</p>
                    <a href="#" class="da-link button">Read more</a>
                    <div class="da-img">
                        <img src="{{ env('THEME') }}/images/Slider01.png" alt="image01" width="320">
                    </div>
                </div>
                <!-- End first slide -->
                <!-- Start second slide -->
                <div class="da-slide">
                    <h2>Easy management</h2>
                    <h4>Easy to use</h4>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <a href="#" class="da-link button">Read more</a>
                    <div class="da-img">
                        <img src="{{ env('THEME') }}/images/Slider02.png" width="320" alt="image02">
                    </div>
                </div>
                <!-- End second slide -->
                <!-- Start third slide -->
                <div class="da-slide">
                    <h2>Revolution</h2>
                    <h4>Customizable</h4>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    <a href="#" class="da-link button">Read more</a>
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
                <p>Здесь ты можешь создавать и участвовать в турнирах, а побеждая получать денежное вознаграждение.</p>
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
            <p class="large-text">Зарегистрируйся в 1 клик! gjkt lkz ddjlf</p>
            <form action="/register" method="post" class="" id="callToAction-form">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="callToActionEmail" type="email" required class="form-control" id="callToActionEmail" placeholder="Email">
                </div>
                <input type="hidden" name="login-with-ajax-call-to-action" value="register">
                <button onclick="return callToAction()" type="button" class="button">Зарегистрироваться</button>
            </form>
        </div>
    </div>
    <!-- Client section start -->
    <div id="games" class="section third-section">
        <div class="container centered">
            <div class="sub-section">
                <div class="title clearfix">
                    <div class="pull-left">
                        <h3>Наши игры</h3>
                    </div>
                    <ul class="client-nav pull-right">
                        <li id="client-prev"></li>
                        <li id="client-next"></li>
                    </ul>
                </div>
                <ul class="row client-slider" id="clint-slider">
                    @foreach($bets as $bet)
                    <li>
                        <a href="javascript:void(0)" onclick="return checkBet('{{ $bet->openUrl() }}', '{{ $bet->game->name }} {{ $bet->bet }}', {{$bet->bet}}, {{Auth::check() ? Auth::user()->credits : 0}}, {{ $bet->game->id }})">
                            <img src="{{ env('THEME') }}/images/{{ $bet->game->getLogo() }}" alt="client logo 1">
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    <!-- Contact section start -->
    <div id="contact" class="contact">
        <div class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>Contact Us</h1>
                    <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
                    <div class="span5 contact-form centered animated bounceIn" style="margin-top: 20px;margin-bottom: 20px;">
                        <h3>Say Hello</h3>
                        <div id="successSend" class="alert alert-success invisible">
                            <strong>Well done!</strong>Your message has been sent.</div>
                        <div id="errorSend" class="alert alert-error invisible">There was an error.</div>
                        <form role="form" id="feedback_form" action="javascript:void(0);" method="POST">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="control-group">
                                <div class="controls">
                                    <input required class="span1" style="width: 93%;" type="text" id="name" name="name" placeholder="* Your name...">
                                    <div class="error left-align" id="err-name">Please enter name.</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input required class="span1" style="width: 93%;" type="email" id="email" name="email" placeholder="* Your name...">
                                    <div class="error left-align" id="err-email">Please enter valid email adress.</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <textarea required class="span1" style="width: 93%;" name="comment" id="comment" placeholder="* Comments..."></textarea>
                                    <div class="error left-align" id="err-comment">Please enter your comment.</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button onclick="return checkFeedbackForm()" class="message-btn">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="span9 center contact-info">
                    <p>123 Fifth Avenue, 12th,Belgrade,SRB 11000</p>
                    <p class="info-mail">ourstudio@somemail.com</p>
                    <p>+11 234 567 890</p>
                    <p>+11 286 543 850</p>
                    <div class="title">
                        <h3>We Are Social</h3>
                    </div>
                </div>
                <div class="row-fluid centered">
                    <ul class="social">
                        <li>
                            <a href="">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-pinterest-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-dribbble-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-gplus-circled"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact section edn -->

@endsection