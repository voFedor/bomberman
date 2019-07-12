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
				<!--form role="form" method="post" action="/send-payment">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="user_id" value="{{$user_id}}" />
					<div class="form-group">
						<label for="email">Сумма:</label>
						<input type="text" class="form-control" name="price" id="price">
					</div>
					<button type="submit" class="button">Пополнить</button>
				</form-->
				<iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9F%D0%BE%D0%BF%D0%BE%D0%BB%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%B1%D0%B0%D0%BB%D0%B0%D0%BD%D1%81%D0%B0&targets-hint=&default-sum=1000&button-text=11&payment-type-choice=on&label={{$user_id}}&mobile-payment-type-choice=on&hint=&successURL={{env('YANDEX_SUCCESS_URL')}}&quickpay=shop&account={{env('YANDEX_SHOP_ID')}}" width="93%" height="223" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
			</div>
		</div>
	</div>
</div>

@endsection
