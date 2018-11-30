<div class="modal fade" id="bets-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="bets-modal-content">

        </div>
    </div>
</div>



<div class="modal fade" id="startGame" tabindex="-1" role="dialog" aria-labelledby="startGame" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content" id="bets-modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="newGame">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" style="color: black;">Какую игру добавить?</h2>
            </div>
            <div class="modal-body">
                <form action="/new-game" method="post" id="newGame-form">
                    {{ csrf_field() }}
                        <textarea style="width: 96%;" id="newGameCommentArea" name="newGameCommentArea"></textarea>

                    <button onclick="return newGameFeedback()" type="button" class="btn btn-primary">Ответить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </form>
            </div>

        </div>
    </div>
</div>








<div class="modal fade" tabindex="-1" role="dialog" id="newUserForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" style="color: black;">Текст</h2>
            </div>
            <div class="modal-body" style="    color: black !important;">
            <p style="    color: black !important;">
                Ваши  данные 
                <br>
                Ник: <span id="new_user_name"></span>
                <br>
                Пароль: <span id="password"></span>
            </p>
            <div class="row-fluid">
                <div class="span12">
                    <form onsubmit="javascript:void(0);">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter">
                      </div>
                      <button onclick="return saveEmail()" type="button" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
            </div>

        </div>
    </div>
</div>





<!-- Modal -->
{{--<div id="betaVersionModal" class="modal fade" role="dialog">--}}
    {{--<div class="modal-dialog">--}}

        {{--<!-- Modal content-->--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<h4 class="modal-title" style="color: black;">Бета версия</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<p style="color: black;">Some text in the modal.</p>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</div>--}}
{{--</div>--}}




<style>
    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 15px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        left: 25px;
        font-size: 36px;
        margin-right: 50px;
        padding: 16px 8px 10px 10px !important;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }

    p{
        font-size: 25px;
    }
</style>


<div id="mySidenav" class="sidenav" style="width: 0;z-index: 999;">
    <a style="padding: 0px 8px 10px 34px;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    @if(Auth::user())
        <a href="javascript:void(0)">Credits: <span class="balance" id="credits">{{ Auth::user()->credits }}</span><span
                    style="text-transform: none;"> рэ</span></a>
    <a href="/history">История побед</a>
    <a href="/payments">Баланс</a>
    <a href="/profile">Профиль</a>
    <a id="wp-logout"
       href="{{ route('auth.logout') }}">Выйти
        @else
            <div style="margin-left: 25px;">
            <div style="text-align: center;">
                <div id="uLogin_500d4447" data-uloginid="500d4447"></div>
            </div>
            <form class="lwa-form block-content" action="/login/" method="post" id="auth-form">
                <span id="error_login" style="color: red;font-size: 16px;"></span>
                <p style="padding: 2px;">
                    Логин/Email: </p>
                <div class="youplay-input">
                    <input type="text" name="log" style="width: auto;">
                </div>
                <p style="padding: 2px;">
                    Пароль: </p>
                <div class="youplay-input">
                    <input type="password" name="pwd" style="width: auto;">
                </div>
                {{--<div class="youplay-checkbox mb-15 ml-5" style="display: -webkit-box;">--}}
                {{--<input type="checkbox" name="rememberme" value="forever" style="margin: 0px 0 0;">--}}
                {{--<label for="rememberme-lwa-1">Запомнить меня</label>--}}
                {{--</div>--}}
                <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="lwa_wp-submit-1"
                        tabindex="100" type="button" onclick="return login()">
                    Войти
                </button>
                <div style="line-height: 3px;">
                    <a href="javascript:void(0);" onclick="return openLostPassForm()" title="Password Lost and Found">Забыл?</a>
                    <a href="javascript:void(0);" onclick="return openRegForm()">Зарегистрироваться</a>
                </div>
                <br>

                {{ csrf_field() }}
                <input type="hidden" name="lwa_profile_link" value="1">
                <input type="hidden" name="login-with-ajax" value="login">
                <p></p>

            </form>
            </div>
            <div style="margin-left: 25px;">
            <form class="lwa-register lwa-register-default block-content" action="/register" method="post" id="reg-form" style="display: none;">
                <span id="error_register" style="color: red;font-size: 16px;"></span>
                <p style="padding: 2px;">
                    Логин/Email: </p>
                <div class="youplay-input">
                    <input type="email" name="user_login" id="user_login-1" style="width: auto;background-color: rgb(250, 255, 189) !important;">
                </div>
                {{ csrf_field() }}

                <input type="hidden" name="login-with-ajax" value="register">
                <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="wp-submit-1" tabindex="100"
                        type="button" onclick="return register()">
                    Зарегистрироваться
                </button>
                <br>
                <div style="line-height: 3px;margin-top: 15px;">
                    <a href="javascript:void(0);" onclick="return openLostPassForm()" title="Password Lost and Found">Забыл?</a>
                    <a href="javascript:void(0);" onclick="return openAuthForm()">Войти</a>
                </div>

            </form>
            </div>
            <div style="margin-left: 25px;">
            <form action="javascript:void(0)" class="lwa-remember block-content" action="/register" method="post" id="forgot-form" style="display: none;">
                <span id="error_forget" style="color: red;font-size: 16px;"></span>
                <p style="padding: 2px;">
                    Логин/Email: </p>
                <div class="youplay-input">
                    <input type="text" name="user_login_remember" id="user_login_remember" style="background-color: rgb(250, 255, 189) !important;width: auto;">
                </div>
                <button onclick="return remember()" class="btn btn-sm ml-0 mr-0" name="wp-submit" id="lwa_wp_3-submit-1" tabindex="100">
                    Отправить пароль
                </button>
                <br>
                <input type="hidden" name="login-with-ajax" value="remember">
                <p></p>
                {{ csrf_field() }}
                <div style="line-height: 3px;">
                    <a href="javascript:void(0);" onclick="return openRegForm()" title="Password Lost and Found">Регистрация</a>
                    <a href="javascript:void(0);" onclick="return openAuthForm()">Войти</a>
                </div>
            </form>
            </div>
        @endif
</div>


