@extends('layouts.lobby')

@section('content')

<!-- Start home section -->
<div class="section secondary-section">
	<div class="triangle"></div>
	<div class="container">
		<p class="large-text">Таблица лидеров Чемпионата</p>
		<div class="row-fluid">
			<div class="span12">
				<table class="table table-dark">
					<thead>
					<tr>
						<th>Место</th>
						<th>Ник</th>
						<th>Баллы</th>
					</tr>
					</thead>
					<tbody>
					@if (count($leaders) > 0)
						@foreach ($leaders as $leader)
							<tr data-entry-id="">
								<td>{{ $leader->position }}</td>
								<td>{{ $leader->name }}</td>
								<td>{{ $leader->score}}</td>
							</tr>
						@endforeach

					@endif

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
