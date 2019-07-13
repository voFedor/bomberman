@extends('layouts.lobby')

@section('content')

    <!-- Start home section -->
    <div class="section secondary-section">
        <div class="triangle"></div>
        <div class="container">
            <p class="large-text">Таблица пользователей Telegram</p>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-dark">
                        <thead>
                        <tr>
							<th>Имя</th>
                            <th>Сообщение</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
								<tr data-entry-id="">
								{!! Form::open(['method' => 'POST']) !!}
									<input name="telegram_id" type="hidden" value="{{ $user->telegram_id }}">
                                    <td>{{ $user->first_name.' '.$user->last_name.' ('.$user->name.')' }}</td>
                                    <td><input type="text" name="message" class="form-control" required></td>
									<td>{!! Form::submit('Отправить', ['class' => 'btn btn-default']) !!}</td>
								{!! Form::close() !!}
								</tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
					{!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
					<div class="form-group">
						<textarea class="form-control" rows="3" name="message_all" required></textarea>
					</div>
						{!! Form::submit('Отправить Всем', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

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