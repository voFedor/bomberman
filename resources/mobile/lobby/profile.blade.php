@extends('layouts.lobby')

@section('content')



    <!-- Start home section -->
    <div class="section secondary-section">
        <div class="triangle"></div>
        <div class="container">
            <div class="row-fluid">
                <div class="span5">

                    <h3>Ваш профиль</h3>
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }} </span> <br>
                                @endforeach
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <form role="form" method="post" action="/profile/save">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                        <div class="form-group" id="cardNumberInput">
                            <label for="email">Имя: <br/> </label>
                            <input value="{{ (Auth::user() != null) ? Auth::user()->first_name : ''}}" type="text" class="form-control" name="first_name" id="first_name">
                        </div>
                        <div class="form-group" id="yandexWalletInput" >
                            <label for="email">Фамилия</label>
                            <input value="{{ (Auth::user() != null) ? Auth::user()->last_name : ''}}" type="text" class="last_name" name="last_name" id="last_name">
                        </div>
                        <div class="form-group" id="yandexWalletInput">
                            <label for="email">Email</label>
                            <input value="{{ (Auth::user() != null) ? Auth::user()->email : ''}}" type="text" class="last_name" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="email">Страна</label>
                            <input value="{{ (Auth::user() != null) ? Auth::user()->country : ''}}" type="text" class="form-control" name="country" id="country">
                        </div>
                        <input type="hidden" value="{{Auth::user()->id }}" name="id">
                        <button type="submit" class="button">Сохранить</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Client section start -->

    <!-- Contact section start -->
    <div id="contact" class="contact">

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