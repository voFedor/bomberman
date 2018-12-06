@extends('layouts.lobby')

@section('content')

    <!-- login -->

    <div class="pages section">
        <div class="container">
            <div class="blog-single">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>@lang('quickadmin.sessions.fields.game_name')</th>
                        <th>@lang('quickadmin.sessions.fields.bet')</th>
                        <th>@lang('quickadmin.sessions.fields.result')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($users_sessions) > 0)
                        @foreach ($users_sessions as $session)
                            <tr data-entry-id="{{ $session->session_id }}">
                                <td field-key='game_name'>{{ $session->session->bet->game->name }}</td>
                                <td field-key='bet'>{{ $session->session->bet->bet }}</td>
                                <td field-key='result'>{{ (Auth::id() == $session->session->winner_id ? 'вы победили' : 'вы проиграли' ) }}</td>
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

    <!-- end login -->





@endsection
