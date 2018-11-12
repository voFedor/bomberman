<div class="modal fade" id="game-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="game-modal-content">

        </div>
    </div>
</div>




<div class="modal fade" style="width: 91%;" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog-custom" role="document">
        <div class="modal-content-custom" id="loginFormContent">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Вход</h4>
                <h6 style="font-size: 14px;" class="modal-title w-100 font-weight-bold"><a onclick="return checkoutRegForm()" href="javascript:void(0)">Регистрация</a></h6>
            </div>
            <form action="javascript:void(0)" method="post" id="auth-form">
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
                <button style="float: left;" class="btn btn-default" onclick="return login()">Войти</button>
                <button class="btn btn-default" data-dismiss="modal" aria-label="Close">cancel</button>
            </div>
            </form>
        </div>
        <div class="modal-content-custom" id="regForm" style="display: none">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Регистрация</h4>
                <h6 style="font-size: 14px;" class="modal-title w-100 font-weight-bold"><a onclick="return checkoutLoginForm()" href="javascript:void(0)">Вход</a></h6>
            </div>
            <form action="javascript:void(0)" action="/register" method="post" id="reg-form"  >
                <div class="modal-body mx-3">
                    <div class="md-form mb-5" style="padding: 10px;">
                        <span id="error_forget" style="color: red;font-size: 16px;"></span>
                        <input type="email"  name="user_login" id="user_login-1" class="form-control validate">
                        <label data-error="wrong" for="regForm-email">Ваш email</label>
                    </div>
                    <input type="hidden" name="login-with-ajax" value="register">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button style="float: left;" class="btn btn-default"  onclick="return register()">Потвердить</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-label="Close">cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

