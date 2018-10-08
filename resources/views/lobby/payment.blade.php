@extends('layouts.lobby')

@section('content')



    <!-- Start home section -->
    <div class="section secondary-section">
        <div class="triangle"></div>
        <div class="container">
            <p class="large-text">Тут можно пополнить свой баланс, вывести деньги и увидеть историю пополнений и снятий </p>
            <div class="row-fluid">
                <div class="span5">

                    <h3>Пополнить баланс</h3>
                    <h5>Принимаем яндекс.деньги, visa/mastercard</h5>
                    <iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9F%D0%BE%D0%BF%D0%BE%D0%BB%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%B1%D0%B0%D0%BB%D0%B0%D0%BD%D1%81%D0%B0%20%D0%B8%D0%B3%D1%80%D0%BE%D0%BA%D0%BE%D0%BC&targets-hint=&default-sum=1000&button-text=11&payment-type-choice=on&mobile-payment-type-choice=on&mail=on&hint=&successURL=http%3A%2F%2Fgamechainger.io%2Fsuccess-payment&quickpay=shop&account=41001915920393&label={{$payment->token}}" width="422" height="223" frameborder="0" allowtransparency="true" scrolling="no"></iframe>

                    <h3>Получить деньги</h3>
                    <h5>При выводе средств мы оставляем у себя комиссию 10%</h5>
                    <form role="form" method="post" action="cash-out">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="form-group" id="">
                            <label for="sel1" style="color: black">Вывести: <br/> Куда будем выводить?</label>
                            <select onchange="return changeTransactionType()" name="transactionType" class="form-control" id="transactionType" style="width: 220px;">
                                <option value="cardNumber">Кредитную карту</option>
                                <option value="yandexWallet">Яндекс Деньги</option>
                            </select>
                        </div>
                        <div class="form-group" id="cardNumberInput">
                            <label for="email">Номер карты: <br/> Укажи номер карты куда вывести деньги</label>
                            <input type="text" class="form-control" name="cardNumber" id="cardNumber">
                        </div>
                        <div class="form-group" id="yandexWalletInput" style="display: none">
                            <label for="email">Номер кошелька: <br/> Укажи номер кошелька куда вывести деньги</label>
                            <input type="text" class="form-control" name="yandexWallet" id="yandexWallet">
                        </div>
                        <div class="form-group">
                            <label for="email">Сумма:<br/> Укажи сумму</label>
                            <input type="text" class="form-control" name="priceCashOut" id="priceCashOut">
                        </div>
                        <label for="email">Деньги поступят тебе на счет в течение 24 часов</label>
                        <button type="button" onclick="return cashOut()" class="button">Отправить запрос на вывод</button>
                    </form>
                </div>
                <div class="span7">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach($payment_history as $payment_h)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$payment_h->amount}}</td>
                                <td>{{$payment_h->created_at}}</td>
                            </tr>
                            <?php $i++;?>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
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
                            <a href="javascript:void(0)" onclick="return checkBet({{Auth::check() ? Auth::user()->credits : 0}}, {{ $game->id }})">
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
                    <a href="https://www.facebook.com/gamechainger/">
                        <span class="icon-facebook-circled"></span>
                    </a>
                </li>
                {{--<li>--}}
                {{--<a href="">--}}
                {{--<span class="icon-twitter-circled"></span>--}}
                {{--</a>--}}
                {{--</li>--}}
                <li>
                    <a href="https://www.linkedin.com/company/gamechainger/">
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