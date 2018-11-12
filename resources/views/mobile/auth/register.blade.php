@extends('mobile.layouts.app')

@section('content')

    <!-- login -->

    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>REGISTER</h3>
            </div>
            <div class="register">
                <div class="row">
                    <form id="regForm" class="col s12" action="javascript:void(0)" method="POST">
                        @csrf
                        {{--<div class="input-field">--}}
                            {{--<input id="name" name="name" type="text" class="validate" placeholder="NAME" required>--}}
                        {{--</div>--}}
                        <div class="input-field">
                            <input id="email" name="email" type="email" placeholder="EMAIL" class="validate" required>
                        </div>
                        {{--<div class="input-field">--}}
                            {{--<input id="password" name="password" type="password" placeholder="PASSWORD" class="validate" required>--}}
                        {{--</div>--}}
                        <button type="button" onclick="return checkRegForm()" class="button-default">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end login -->


@endsection
