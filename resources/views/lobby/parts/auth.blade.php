
@if(!Auth::check())
    <li><a href="javascript:void(0);" id="auth-link" onclick="return openPopupForm()"><i class="fa fa-fw fa-user" ></i></a></li>

    <input type="hidden" value="0" id="authCheck">
    <div class="hide auth" id="auth">
        <div class="centered-page" id="result">
        </div>
        <form class="lwa-form block-content" action="/login/" method="post" id="auth-form">
            <span id="error_login" style="color: red;font-size: 16px;"></span>
            <p style="padding: 2px;">
                Логин/Email: </p>
            <div class="youplay-input">
                <input type="text" name="log">
            </div>
            <p style="padding: 2px;">
                Пароль: </p>
            <div class="youplay-input">
                <input type="password" name="pwd">
            </div>
            <div class="youplay-checkbox mb-15 ml-5" style="display: -webkit-box;">
                <input type="checkbox" name="rememberme" value="forever" style="margin: 0px 0 0;">
                <label for="rememberme-lwa-1">Запомнить меня</label>
            </div>
            <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="lwa_wp-submit-1"
                    tabindex="100" type="button" onclick="return login()">
                Войти
            </button>
            <br>

            {{ csrf_field() }}
            <input type="hidden" name="lwa_profile_link" value="1">
            <input type="hidden" name="login-with-ajax" value="login">
            <p></p>
            <a href="javascript:void(0);" onclick="return openLostPassForm()" title="Password Lost and Found">Забыл?</a> |
            <a href="javascript:void(0);" onclick="return openRegForm()">Зарегистрироваться</a>
        </form>
        <form class="lwa-register lwa-register-default block-content" action="/register" method="post" id="reg-form" style="display: none;">
            <span id="error_register" style="color: red;font-size: 16px;"></span>
            <p style="padding: 2px;">
                Логин/Email: </p>
            <div class="youplay-input">
                <input type="email" name="user_login" id="user_login-1">
            </div>
            {{ csrf_field() }}

            <input type="hidden" name="login-with-ajax" value="register">
            <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="wp-submit-1" tabindex="100"
                    type="button" onclick="return register()">
                Зарегистрироваться
            </button>
            <br>

            <p></p>
            <a href="javascript:void(0);" onclick="return openLostPassForm()" title="Password Lost and Found">Забыл?</a> |
            <a href="javascript:void(0);" onclick="return openAuthForm()">Войти</a>
        </form>
        <form action="javascript:void(0)" class="lwa-remember block-content" action="/register" method="post" id="forgot-form" style="display: none;">
            <span id="error_forget" style="color: red;font-size: 16px;"></span>
            <p style="padding: 2px;">
                Логин/Email: </p>
            <div class="youplay-input">
                <input type="text" name="user_login_remember" id="user_login_remember">
            </div>
            <button onclick="return remember()" class="btn btn-sm ml-0 mr-0" name="wp-submit" id="lwa_wp_3-submit-1" tabindex="100">
                Отправить пароль
            </button>
            <br>
            <input type="hidden" name="login-with-ajax" value="remember">
            <p></p>
            {{ csrf_field() }}
            <a href="javascript:void(0);" onclick="return openAuthForm()">Вход</a> |
            <a href="javascript:void(0);" onclick="return openRegForm()">Регистрация</a>
        </form>


        <div id="user_info_block" style="display: none;">
            Credits: <span class="balance" id="credits"></span><span
                    style="text-transform: none;"> рэ</span><br>
            <span id="user_email"></span>
            <a id="wp-logout"
               href="{{ route('auth.logout') }}">Выйти</a>
        </div>
    </div>

@else
    <li><a href="javascript:void(0);" id="auth-link" onclick="return openPopupInfo()"><i class="fa fa-fw fa-user" ></i></a></li>
    <li><a href="/history">История побед</a></li>
    <li><a href="/payments">Платежи</a></li>
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