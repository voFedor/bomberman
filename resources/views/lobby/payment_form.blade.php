@extends('layouts.lobby')

@section('content')

<!-- Start home section -->
<div class="section secondary-section">
	<div class="triangle"></div>
	<div class="container">
		<div class="row-fluid">
			<div class="span5">
				<h3>Пополнить баланс</h3>
				<h5>Принимаем яндекс.деньги, visa/mastercard</h5>
				<form role="form" method="post" action="/send-payment">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="user_id" value="{{$user_id}}" />
					<div class="form-group">
						<label for="email">Сумма:</label>
						<input type="text" class="form-control" name="price" id="price">
					</div>
					<button type="submit" class="button">Оплатить</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
