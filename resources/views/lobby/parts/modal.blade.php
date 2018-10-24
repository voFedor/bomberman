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