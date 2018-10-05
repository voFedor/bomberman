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
        $( "#yandexWallet" ).fadeToggle();
        $( "#cardNumber" ).toggle('show');
    } else {
        $( "#yandexWallet" ).toggle('show');
        $( "#cardNumber" ).fadeToggle();
    }
}



function showErrorLogin(error){
    $("#error_login").append(error);
}

function showErrorReg(error){
    $("#error_register").append(error);
}



$('body').on('click', function(e) {
    $('[data-toggle=popover]').each(function() {
        // hide any open popovers when the anywhere else in the body is clicked
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});