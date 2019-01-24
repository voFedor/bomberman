@extends('backend.layouts.app')

@section('content')
    
    <div class="container">
        <form action="{{ route('admin.setting.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">URL callback для TelegramBot</label>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown" aria-hidden="true" aria-expanded="false">
                            Действие <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick="document.getElementById('url_callback_bot').value = '{{ url('') }}'">Вставить url</a></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('setwebhook').submit()">Отправить url</a></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('getwebhookinfo').submit()">Получить информацию</a></li>
                        </ul>
                    </div>
                    <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot"
                    value="{{$url_callback_bot or ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="">Имя сайта для главной страницы</label>
                <input type="text" class="form-control" name="site_name"
                           value="{{ $site_name or ''}}">
            </div>
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </form>

        <form style="display: none" id="setwebhook" action="{{ route('admin.setting.setwebhook') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="url" value="{{ $site_name or ''}}">
        </form>

        <form style="display: none" id="getwebhookinfo" action="{{ route('admin.setting.getwebhookinfo') }}" method="post">
            {{ csrf_field() }}
        </form>
    </div>
@endsection