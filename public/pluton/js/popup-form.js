function openPopupForm() {
            $('#auth-link').popover({
                placement: 'bottom',
                title: 'Вход на сайт',
                html: true,
                content: $('#auth').html()
            })
}


function openPopupInfo() {

    $('#auth-link').popover({
        placement: 'bottom',
        title: 'Информация',
        html: true,
        content: $('#info').html()
    });
}



function openRegForm() {
    $('#auth-form').hide();
    $('#forgot-form').hide();
    $('#reg-form').show();
}

function openAuthForm() {
    $('#reg-form').hide();
    $('#forgot-form').hide();
    $('#auth-form').show();
}

function openLostPassForm() {
    $('#auth-form').hide();
    $('#reg-form').hide();
    $('#forgot-form').show();
}



function changeTransactionType(){
    var type = $( "#transactionType option:selected" ).val();
    if (type == "cardNumber") {
        $( "#yandexWalletInput" ).fadeToggle();
        $( "#cardNumberInput" ).toggle('show');
    } else {
        $( "#yandexWalletInput" ).toggle('show');
        $( "#cardNumberInput" ).fadeToggle();
    }
}



function showErrorLogin(error){
    toastr.clear();
    toastr.error(error, 'Ошибка!', {timeOut: 3000});
}

function showErrorReg(error){
    $("#error_register").val();
    $("#error_register").val(error);
}



$('body').on('click', function(e) {
    $('#auth-link').each(function() {
        // hide any open popovers when the anywhere else in the body is clicked
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('#uth-link').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});
