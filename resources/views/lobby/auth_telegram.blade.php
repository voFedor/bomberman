@extends('layouts.lobby')

@section('content')

@if(!Auth::check())
<!-- Start section -->
<div class="section secondary-section">
	<div class="container">
		<div class="row-fluid">
			<form class="lwa-form block-content" action="/login/" method="post" id="auth-form">
				{{ csrf_field() }}
				<input type="hidden" name="lwa_profile_link" value="1">
				<input type="hidden" name="login-with-ajax" value="login">
				<span id="error_login" style="color: red;font-size: 16px;"></span>
				<p style="padding: 2px; font-size:1.5rem;">
					Telegram Ник:<br />
					<span style="font-size:1rem; color:#000;">Вы можете его увидеть в нашем боте, нажав на пункт меню "my_profile"</span>
				</p>
				<div class="youplay-input">
					<input type="text" name="log" style="width: auto; border: 1px solid #fcbf35; background-color: rgb(102,101,93); color: white; ">
				</div>
				<p style="padding: 2px;">
					Пароль:<br />
					<span style="font-size:1rem; color:#000;">Пароль был выдан Вам при нажатии на кнопку "СТАРТ" нашего бота @gamechainger_bot</span>
				</p>
				<div class="youplay-input">
					<input type="password" name="pwd" style="width: auto; border: 1px solid #fcbf35; background-color: rgb(102,101,93); color: white;">
				</div>
				<button class="button" name="wp-submit" id="lwa_wp-submit-1" tabindex="100" type="button" onclick="return login('auth-form')">
					Войти
				</button>
			</form>
		</div>
	</div>
</div>
@endif

@endsection
