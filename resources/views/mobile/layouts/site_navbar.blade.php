<div class="side-nav-panel-right">
    <ul id="slide-out-right" class="side-nav side-nav-panel collapsible">
        @if(Auth::user())
        <li class="profil">
            <img src="{{Auth::user()->photo}}" alt="">
            <h2>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
        </li>
            <li style="text-align: -webkit-center;margin-top: 15px;">
                Баланс: {{ Auth::user()->credits }}р.
            </li>
            <li><a href="/payments"><i class="fa fa-money"></i>Пополнить/снять</a></li>
            <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-in"></i>Выход</a></li>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @else
            <li style="text-align: -webkit-center;margin-top: 15px;">
            {{--<h5>Вы не авторизированы</h5>--}}
            {{--<a>войти через социальные сети</a>--}}
            </li>
            <li style="text-align: -webkit-center;margin-top: 15px;">
                <div id="uLogin500d4447" data-ulogin="display=panel;fields=first_name,last_name,email,nickname,photo;optional=country;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=google,yandex,linkedin;redirect_uri=http://{{env('APP_URL')}}/ulogin;callback=preview"></div>
            </li>
        <li><a href="/mlogin"><i class="fa fa-sign-in"></i>Вход</a></li>
        <li><a href="/mregister"><i class="fa fa-user-plus"></i>Регистрация</a></li>
    </ul>
    @endif

</div>
