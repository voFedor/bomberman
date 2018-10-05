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
                    <h5>Укажи свой яндекс.деньги или номер карты visa/mastercard</h5>
                    <h5>Сумму, при выводе средств мы оставляем у себя комиссию 10%</h5>
                    <form role="form" method="post" action="cash-out">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="form-group" id="">
                            <label for="sel1" style="color: black">Вывести:</label>
                            <select onchange="return changeTransactionType()" name="transactionType" class="form-control" id="transactionType" style="width: 220px;">
                                <option value="cardNumber">Кредитную карту</option>
                                <option value="yandexWallet">Яндекс Деньги</option>
                            </select>
                        </div>
                        <div class="form-group" id="cardNumberInput">
                            <label for="email">Номер карты:</label>
                            <input type="text" class="form-control" name="cardNumber" id="cardNumber">
                        </div>
                        <div class="form-group" id="yandexWalletInput" style="display: none">
                            <label for="email">Номер кошелька:</label>
                            <input type="text" class="form-control" name="yandexWallet" id="yandexWallet">
                        </div>
                        <div class="form-group">
                            <label for="email">Сумма:</label>
                            <input type="text" class="form-control" name="priceCashOut" id="priceCashOut">
                        </div>
                        <button type="button" onclick="return cashOut()" class="button">Получить</button>
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
                <div class="title">
                    <h1>Contact Us</h1>
                    <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
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