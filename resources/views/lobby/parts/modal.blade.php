<div class="modal fade" id="bets-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="bets-modal-content">

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="callToAction">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" style="color: black">Регистрация</h2>
            </div>
            <div class="modal-body">
                <form action="/register" method="post" class="" id="callToAction-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input name="callToActionEmail" type="email" required class="form-control" id="callToActionEmail" placeholder="Email">
                    </div>
                    <input type="hidden" name="login-with-ajax-call-to-action" value="register">
                        <button onclick="return callToAction()" type="button" class="btn btn-primary">Зарегистрироваться</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </form>
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