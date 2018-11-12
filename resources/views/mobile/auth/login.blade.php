@extends('mobile.layouts.app')

@section('content')

<!-- login -->

<div class="pages section">
    <div class="container">
        <div class="pages-head">
            <h3>LOGIN</h3>
        </div>
        <div class="login">
            <div class="row">
                <script src="//ulogin.ru/js/ulogin.js"></script>

                <form class="col s12" action="javascript:void(0)" method="POST" id="loginForm">
                    <div class="input-field">
                        <input id="email" name="email" type="text" class="validate" placeholder="USERNAME" required>
                    </div>
                    <div class="input-field">
                        <input id="password" name="password"  type="password" class="validate" placeholder="PASSWORD" required>
                    </div>
                    <a href=""><h6>Forgot Password ?</h6></a>
                    <button type="button" onclick="return checkLoginForm()" class="button-default">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end login -->


@endsection
