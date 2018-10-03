<div class="modal-header">
    <h1 style="color:black" class="modal-title" id="exampleModalLabel">Выберите ставку</h1>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" style="color: black;">
    @if(count($bets) != 0)
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
                    <button onclick="return pickBet('{{$bet->id}}', '{{$bet->openUrl()}}', '{{$bet->bet}}')" type="button" class="btn btn-warning">Выбрать</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <h3>Ставок нет</h3>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
</div>