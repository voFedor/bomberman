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



<!--div class="modal fade" tabindex="-1" role="dialog" id="newGame">
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
</div-->








<!--div class="modal fade" tabindex="-1" role="dialog" id="newUserForm">
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
</div-->





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
        background-color: rgba(0, 0, 0, 0.77);
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 15px;
        color: #ffffff;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #fcbf35;
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


<div id="mySidenav" class="sidenav" style="width: 0;z-index: 9999;">
    <a style="padding: 0px 8px 10px 34px;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    @if(Auth::user())
        <p>{{Auth::user()->name}}</p>
        <p href="javascript:void(0)">Credits: <span class="balance" id="credits">{{ Auth::user()->credits }}</span><span style="text-transform: none;"> рэ</span></p>
		<a href="/history">История побед</a>
		<a href="/challenge">Вызовы</a>
		<a href="/payments">Баланс</a>
		<a href="/invitations">Ивайты</a>
		<a href="/profile">Профиль</a>
		<a id="wp-logout" href="{{ route('auth.logout') }}">Выйти
    @else
            <div style="margin-left: 25px;">
            <div style="text-align: center;">
            </div>
               <p> войти с помощью </p>
                <div style="display: inline-flex;">
                   <a class="btn  btn-social-icon btn-vk" style="width: 20px;color: black;padding: 4px 12px;" href="/redirectToSocial/vkontakte">
                       <span class="fa fa-vk"></span>
                   </a>
                   <a class="btn btn-social-icon btn-facebook" style="width: 20px;color: black;padding: 4px 12px;margin-right: 10px;margin-left: 10px;" href="/redirectToSocial/facebook">
                       <span class="fa fa-facebook"></span>
                   </a>
                </div>
                <p> или введи </p>
            <form class="lwa-form block-content" action="/login/" method="post" id="auth-form">
                <span id="error_login" style="color: red;font-size: 16px;"></span>
                <p style="padding: 2px;">
                    Логин/Email: </p>
                <div class="youplay-input">
                    <input type="text" name="log" style="width: auto; border: 1px solid #fcbf35; background-color: rgb(102,101,93); color: white; ">
                </div>
                <p style="padding: 2px;">
                    Пароль: </p>
                <div class="youplay-input">
                    <input type="password" name="pwd" style="width: auto; border: 1px solid #fcbf35; background-color: rgb(102,101,93); color: white;">
                </div>
                {{--<div class="youplay-checkbox mb-15 ml-5" style="display: -webkit-box;">--}}
                {{--<input type="checkbox" name="rememberme" value="forever" style="margin: 0px 0 0;">--}}
                {{--<label for="rememberme-lwa-1">Запомнить меня</label>--}}
                {{--</div>--}}
                <button class="btn btn-sm ml-0 mr-0" name="wp-submit" id="lwa_wp-submit-1"
                        tabindex="100" type="button" onclick="return login('auth-form')">
                    Войти
                </button>
                <div style="line-height: 13px;">
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
                        type="button" onclick="return register('reg-form')">
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
<div id="paymentBtn" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="text-align: center;">
                <h4 class="modal-title w-100 font-weight-bold">На твоем счету не достаточно средств, чтобы сделать ставку<br/>Пожалуйста пополни счет </h4>
                <a href="/payments" style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-info">Пополнить счет</a>
            </div>
        </div>
    </div>






<!--div id="loginForm" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="color: black;">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content modal-content-custom" id="loginFormContent">
            <div class="modal-header text-center">




                <h4 class="modal-title w-100 font-weight-bold">Вход</h4>
                <h6 style="font-size: 14px;" class="modal-title w-100 font-weight-bold"><a onclick="return checkoutRegForm()" href="javascript:void(0)">Регистрация</a></h6>
            </div>

            <form action="javascript:void(0)" method="post" id="auth-form-tmp" style="text-align: -webkit-center;">
                <a class="btn btn-social btn-vk" style="padding: 0 1.1rem;" href="/login/vk">
                    <span class="fa fa-vk"></span>
                </a>
            <form action="javascript:void(0)" method="post" id="auth-form-popup" style="text-align: -webkit-center;">
                <div class="modal-body mx-3">
                    <div class="md-form mb-5" style="padding: 10px;">
                        <input  name="log" type="email" id="loginForm-email" class="form-control validate">
                        <label data-error="wrong" for="default-email">Ваш email</label>
                    </div>

                    <div class="md-form mb-4" style="padding: 10px;">
                        <input type="password" id="default-pass" name="pwd" class="form-control validate">
                        <label data-error="wrong" for="loginForm-pass">Пароль</label>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button style="float: left;" class="btn btn-default" onclick="return login('auth-form-popup')">Войти</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-label="Close">cancel</button>
                </div>
            </form>
        </div>
        <div class="modal-content modal-content-custom" id="regForm" style="display: none">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Регистрация</h4>
                <h6 style="font-size: 14px;" class="modal-title w-100 font-weight-bold"><a onclick="return checkoutLoginForm()" href="javascript:void(0)">Вход</a></h6>
            </div>
            <form action="javascript:void(0)" action="/register" method="post" id="regForm-popup"   style="text-align: -webkit-center;">
                <div class="modal-body mx-3">
                    <div class="md-form mb-5" style="padding: 10px;">
                        <span id="error_forget" style="color: red;font-size: 16px;"></span>
                        <input type="email"  name="user_login" id="user_login-1-mySmallModalLabel" class="form-control validate">
                        <label data-error="wrong" for="regForm-email">Ваш email</label>
                    </div>
                    <input type="hidden" name="login-with-ajax" value="register">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button style="float: left;" class="btn btn-default"  onclick="return register('regForm-popup')">Потвердить</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-label="Close">cancel</button>
                </div>
            </form>

        </div>
    </div>
</div-->
