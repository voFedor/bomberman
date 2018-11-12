@extends('layouts.app')

@section('content')

    <!-- login -->

    <div class="pages section">
        <div class="container">
            <div class="blog-single">
                @if($last_duel_token != null)
                    <h3  style="margin-left: 20px;">Твоя ссылка на последнюю дуэль</h3>
                    <p id="duel-url" class="large-text">{{ env('APP_URL').'/pvp/'.$last_duel_token->token }}</p>

                    <!-- Trigger -->
                    <button class="btn" onclick="copyToClipboard('#duel-url')" style="margin-left: 20px;">
                        Скопировать ссылку
                    </button>
                @endif
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>Игра</th>
                        <th>Ставка</th>
                        <th>Ссылка на игру</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($duels) > 0)
                        @foreach ($duels as $duel)
                            <tr>
                                <td>{{ $duel->game->name }}</td>
                                <td>{{ $duel->bet->bet }}</td>
                                <td>{{ env('APP_URL').'/pvp/'.$duel->token }}</td>
                                <td>
                                    <span id="status_{{ $duel->id }}">
                                    {{ $duel->status == App\Models\Duel::OPEN ? "Приглашение отправлено" : "Приглашение принято" }}
                                        </span>
                                </td>
                                <td>
                                    <button onclick="return refreshStatus({{ $duel->id }})" data-toggle="tooltip" title="Обновить статус" class="btn btn-info"><i class="fa fa-refresh"></i></button>
                                </td>
                                <td>
                                    @if($duel->status != 3)
                                        <a onclick="return pickBet('{{$duel->bet->id}}', '{{$duel->bet->openUrl()}}', '{{$duel->bet->bet}}', '{{$duel->id}}')" href="javascript:void(0)" class="btn btn-info">Играть</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>Вы еще никого не вызвали на дуэль</td>
                        </tr>
                    @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- end login -->


@endsection
