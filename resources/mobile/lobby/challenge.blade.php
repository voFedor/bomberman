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
                            <th>Игра</th>
                            <th>Ставка</th>
                            <th>Противник</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($sessions) > 0)
                            @foreach ($sessions as $session)

                                <tr>
                                    <td>{{$session->game->name}}</td>
                                    <td>{{$session->bet->bet}}</td>
                                    <td>{{$session->users_sessions->where('user_id', '!=', Auth::user()->id)->first()->user->name}}</td>
                                    <td>

                                        @if($session->users_sessions->where('user_id', Auth::user()->id)->first()->score == null)
                                            <button onclick="return checkBalanceFromChallenge('{{$session->game->id}}', '{{$session->bet->id}})', '{{$session->uuid}}')" style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-info">Играть</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Client section start -->


    </div>
    </div>
    <!-- Contact section edn -->

@endsection