<div class="modal-header">
    <h1 style="color:black" class="modal-title" id="exampleModalLabel">Выберите ставку</h1>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" style="color: black;">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Ставка</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($bets as $bet)
            <tr>
                <th scope="row">{{$bet->bet}}</th>
                <td>
                    <button onclick="return pickBet('{{$bet->id}}', '{{$url}}', '{{$info}}')" type="button" class="btn btn-primary">Выбрать</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
</div>