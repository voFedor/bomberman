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
                            <th>@lang('quickadmin.sessions.fields.id')</th>
                            <th>@lang('quickadmin.sessions.fields.game_name')</th>
                            <th>@lang('quickadmin.sessions.fields.credits_before')</th>
                            <th>@lang('quickadmin.sessions.fields.bet')</th>
                            <th>@lang('quickadmin.sessions.fields.result')</th>
                            <th>@lang('quickadmin.sessions.fields.credits_after')</th>
                            <th>@lang('quickadmin.sessions.fields.started_at')</th>
                            <th>@lang('quickadmin.sessions.fields.ended_at')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($sessions) > 0)
                            @foreach ($sessions as $game)
                                <tr data-entry-id="{{ $game->id }}">
                                    <td field-key='id'>{{ $game->id }}</td>
                                    <td field-key='game_name'>{{ $game->name }}</td>
                                    <td field-key='credits_before'>{{ $game->credits_before }}</td>
                                    <td field-key='bet'>{{ $game->bet }}</td>
                                    <td field-key='result'>{{ (Auth::id() == $game->winner_id ? 'win' : (isset($game->ended_at) ? 'lose' : '')) }}</td>
                                    <td field-key='credits_after'>{{ $game->credits_after }}</td>
                                    <td field-key='started_at'>{{ $game->started_at }}</td>
                                    <td field-key='ended_at'>{{ $game->ended_at }}</td>
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
    <div id="games" class="section third-section">
        <div class="container centered">
            <div class="sub-section">
                <div class="title clearfix">
                    <div class="pull-left">
                        <h3>Игры</h3>
                    </div>
                    <ul class="client-nav pull-right">
                        <li id="client-prev"></li>
                        <li id="client-next"></li>
                    </ul>
                </div>
                <ul class="row client-slider" id="clint-slider">
                    @foreach($games as $game)
                        <li>
                            <a href="javascript:void(0)" onclick="return checkBet({{Auth::check() ? Auth::user()->credits : 0}}, {{ $game->id }})">
                                <img src="{{ env('THEME') }}/images/{{ $game->getLogo() }}" alt="client logo 1">
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="#" data-toggle="modal" data-target="#newGame">
                            <img src="{{ env('THEME') }}/images/games/cs-go.png" alt="client logo 1">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Contact section start -->
    <div id="contact" class="contact">
        <div class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>Contact Us</h1>
                    <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
                </div>
            </div>
            <div class="container">
                <div class="span9 center contact-info">
                    <p>123 Fifth Avenue, 12th,Belgrade,SRB 11000</p>
                    <p class="info-mail">ourstudio@somemail.com</p>
                    <p>+11 234 567 890</p>
                    <p>+11 286 543 850</p>
                    <div class="title">
                        <h3>We Are Social</h3>
                    </div>
                </div>
                <div class="row-fluid centered">
                    <ul class="social">
                        <li>
                            <a href="">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-pinterest-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-dribbble-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-gplus-circled"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact section edn -->

@endsection