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
        font-size: 25px;
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
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
</style>


<div id="mySidenav" class="sidenav" style="width: 0;z-index: 999;">
    <a style="padding: 0px 8px 10px 34px;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;
    @if(Auth::user())
        <a href="javascript:void(0)">Credits: <span class="balance" id="credits">{{ Auth::user()->credits }}</span><span
                    style="text-transform: none;"> рэ</span></a>
    <a href="/history">История побед</a>
    <a href="/payments">Баланс</a>
    <a href="/profile">Профиль</a>
    <a id="wp-logout"
       href="{{ route('auth.logout') }}">Выйти
        @endif
</div>
