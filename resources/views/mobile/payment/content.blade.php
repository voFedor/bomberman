@extends('mobile.layouts.app')

@section('content')

    <!-- login -->

    <div class="pages section">
        <div class="container">
            <div class="blog-single">
                <h2> Баланс: {{ Auth::user()->credits }}р.</h2>
                <h3><br/>Пополнить</h3>
                <h5><br/>Введите сумму и нажмите "Пополнить", вы будете перенаправлены на страницу оплаты Яндекс.Касса</h5>
                <form class="col s12 form-details" method="POST" action="/makeDeposit">
                    @csrf
                    <input type="hidden" name="need-email" value="true">
                    <input type="hidden" name="receiver" value="41001xxxxxxxxxxxx">
                    <input type="hidden" name="formcomment" value="Пополнение счета">
                    <div class="input-field">

                        <input name="cart" type="text" value="" required="" class="validate" placeholder="Номер карты">
                    </div>
                    <div class="input-field">

                        <input name="sum" type="text" value="1000" data-type="number" required="" class="validate" placeholder="Сумма">
                    </div>
                    <div class="form-button">
                        <button type="submit" class="button-default">Пополнить</button>
                    </div>
                </form>

                <h3><br/>Снять</h3>
                <h5><br/>Введите сумму и номер карты, деньги будут перечислены в течение 24 часов</h5>
                <form class="col s12 form-details" action="/payments" method="post">
                    @csrf
                    <div class="input-field">
                        <input name="sum" type="text" required="" class="validate" placeholder="Сумма">
                    </div>
                    <div class="input-field">
                        <input name="sum" type="text" required="" class="validate" placeholder="Номер карты">
                    </div>
                    <div class="form-button">
                        <button class="button-default">Снять</button>
                    </div>
                </form>
                {{--<iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9F%D0%BE%D0%BF%D0%BE%D0%BB%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%B1%D0%B0%D0%BB%D0%B0%D0%BD%D1%81%D0%B0&targets-hint=&default-sum=1000&button-text=11&payment-type-choice=on&mobile-payment-type-choice=on&mail=on&hint=&successURL=http%3A%2F%2Fgamechainger.io%2Fpayments&quickpay=shop&account=41001915920393&label={{Auth::user()->id}}&=" width="290" height="250" frameborder="0" allowtransparency="true" scrolling="no"></iframe>--}}
            </div>
        </div>
    </div>
    <!-- end login -->


@endsection
