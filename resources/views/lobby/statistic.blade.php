@extends('layouts.lobby')

@section('content')



    <!-- Start home section -->
    <div class="section secondary-section">
        <div class="triangle"></div>
        <div class="container">
            <p class="large-text">Страница где ты можешь посмотреть историю своих побед и запомнить обидчиков, чтобы взять реванш</p>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Зарегистрировался</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr data-entry-id="">
                                    <td>{{ $user->first_name.' '.$user->last_name.' ('.$user->name.')' }}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->created_at}}</td>
                                </tr>

                            @endforeach

                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Действие</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($actions) > 0)
                            @foreach ($actions as $action)
                                <tr data-entry-id="">
                                    <td>{{ $action->user->email }}</td>
                                    <td>{{ $action->action }}</td>
                                    <td>{{ $action->created_at}}</td>
                                </tr>
                            @endforeach

                        @endif

                        </tbody>
                    </table>
                </div>
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