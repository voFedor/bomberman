
@if(!Auth::check())
    <li><a href="javascript:void(0);" id="auth-link" onclick="return openPopupInfo()">Профиль</a></li>


@else
    <li><a href="javascript:void(0);" id="auth-link" onclick="return openPopupInfo()">Профиль</a></li>
    <div class="hide auth" id="info">
        Credits: <span class="balance" id="credits">{{ Auth::user()->credits }}</span><span
                style="text-transform: none;"> рэ</span><br>
        {{Auth::user()->email}} <br>
        {{--<a id="wp-logout"--}}
        {{--href="{{ route((Auth::check() ? Auth::user()->getSlugRole() : '') . '.home') }}">Статистика побед</a>--}}
        {{--<br>--}}
        <a id="wp-logout"
           href="{{ route('auth.logout') }}">Выйти</a>
    </div>
@endif