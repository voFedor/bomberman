
@if(!Auth::check())
    <li><a href="javascript:void(0);" id="auth-link" onclick="return openPopupForm()"><i class="fa fa-fw fa-user" ></i></a></li>

    <input type="hidden" value="0" id="authCheck">
    <div class="hide auth" id="auth">
        <div class="centered-page" id="result">
        </div>
        <form class="lwa-form block-content" action="/login/" method="post" id="auth-form">
            <span id="error_login" style="color: red;font-size: 16px;"></span>
            <p style="padding: 2px;">
                Username/Email: </p>
            <div class="youplay-input">
                <input type="text" name="log">
            </div>
            <p style="padding: 2px;">
                Password: </p>
            <div class="youplay-input">
                <input type="password" name="pwd">
            </div>
            <div class="youplay-checkbox mb-15 ml-5" style="display: -webkit-box;">
                <input type="checkbox" name="rememberme" value="forever" style="margin: 0px 0 0;">
                <label for="rememberme-lwa-1">Remember Me</label>
            </div>
            <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="lwa_wp-submit-1"
                    tabindex="100" type="button" onclick="return login()">
                Log In
            </button>
            <br>

            {{ csrf_field() }}
            <input type="hidden" name="lwa_profile_link" value="1">
            <input type="hidden" name="login-with-ajax" value="login">
            <p></p>
            <a href="javascript:void(0);" onclick="return openLostPassForm()" title="Password Lost and Found">Lost password?</a> |
            <a href="javascript:void(0);" onclick="return openRegForm()">Register</a>
        </form>
        <form class="lwa-register lwa-register-default block-content" action="/register" method="post" id="reg-form" style="display: none;">
            <span id="error_register" style="color: red;font-size: 16px;"></span>
            <p style="padding: 2px;">
                Username/Email: </p>
            <div class="youplay-input">
                <input type="text" name="user_login" id="user_login-1">
            </div>
            <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="wp-submit-1" tabindex="100"
                    type="button" onclick="return register()">
                Register
            </button>
            <br>
            {{ csrf_field() }}

            <input type="hidden" name="login-with-ajax" value="register">
            <p></p>
            <a href="javascript:void(0);" onclick="return openLostPassForm()" title="Password Lost and Found">Lost password?</a> |
            <a href="javascript:void(0);" onclick="return openAuthForm()">Login</a>
        </form>
        <form class="lwa-remember block-content" action="/login/" method="post" id="forgot-form" style="display: none;">
            <span id="error_forget" style="color: red;font-size: 16px;"></span>
            <p style="padding: 2px;">
                Username/Email: </p>
            <div class="youplay-input">
                <input type="text" name="log">
            </div>
            <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="lwa_wp_3-submit-1" tabindex="100">
                Send password
            </button>
            <br>
            <input type="hidden" name="login-with-ajax" value="remember">
            <p></p>
            <a href="javascript:void(0);" onclick="return openAuthForm()">Login</a> |
            <a href="javascript:void(0);" onclick="return openRegForm()">Register</a>
        </form>


        <div id="user_info_block" style="display: none;">
            Credits: <span class="balance" id="credits"></span><span
                    style="text-transform: none;"> mBTC</span><br>
            <span id="user_email"></span>
            <a id="wp-logout"
               href="{{ route('auth.logout') }}">Log
                Out</a>
        </div>
        {{--<li id="history_menu" style="display: none"><a href="/history">История</a></li>--}}
        {{--<li id="payments_menu" style="display: none"><a href="/payments">Платежи</a></li>--}}
    </div>

@else
    <li><a href="javascript:void(0);" id="auth-link" onclick="return openPopupInfo()"><i class="fa fa-fw fa-user" ></i></a></li>
    <div class="hide auth" id="info">
        Credits: <span class="balance" id="credits">{{ Auth::user()->credits }}</span><span
                style="text-transform: none;"> mBTC</span><br>
        {{Auth::user()->email}} <br>
        <a id="wp-logout"
           href="{{ route((Auth::check() ? Auth::user()->getSlugRole() : '') . '.home') }}">Dashboard</a>
        <br>
        <a id="wp-logout"
           href="{{ route('auth.logout') }}">Log
            Out</a>
    </div>
    <li><a href="/history">История</a></li>
    <li><a href="/payments">Платежи</a></li>
@endif