<div class="side-nav-panel-right">
    <ul id="slide-out-right" class="side-nav side-nav-panel collapsible">
        @if(Auth::user())
        <li class="profil">
            <img src="{{Auth::user()->photo}}" alt="">
            <p> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
            <p>Баланс: {{ Auth::user()->credits }}р.</p>
        </li>
            {{--<li style="text-align: -webkit-center;margin-top: 15px;" id="gamer_balance">--}}
                {{--Баланс: {{ Auth::user()->credits }}р.--}}
            {{--</li>--}}
            <li style="margin-top: 10px;"><a href="/payments"><i class="fa fa-money"></i>Баланс</a></li>
            <li><a href="/profile"><i class="fa fa-user-plus"></i>Профиль</a></li>
            <li><a href="/history"><i class="fa fa-list"></i>История побед</a></li>
            <li><a href="/challenge"><i class="fa fa-users"></i>Вызовы</a></li>
            <li ><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-in"></i>Выход</a></li>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @else
            <li style="text-align: -webkit-center;margin-top: 15px;">
            {{--<h5>Вы не авторизированы</h5>--}}
            {{--<a>войти через социальные сети</a>--}}
            </li>
            <li style="text-align: -webkit-center;margin-top: 15px;">
                <a class="btn  btn-social-icon btn-vk" style="width: 20px;color: black;padding: 4px 12px;" href="/redirectToSocial/vkontakte">
                    <span class="fa fa-vk"></span>
                </a>
                <a class="btn btn-social-icon btn-facebook" style="width: 20px;color: black;padding: 4px 12px;margin-right: 10px;margin-left: 10px;" href="/redirectToSocial/facebook">
                    <span class="fa fa-facebook"></span>
                </a>
            </li>
        <li style="margin-top: 110px;"><a href="/mlogin"><i class="fa fa-sign-in"></i>Вход</a></li>
        <li><a href="/mregister"><i class="fa fa-user-plus"></i>Регистрация</a></li>

    </ul>
    @endif

</div>
