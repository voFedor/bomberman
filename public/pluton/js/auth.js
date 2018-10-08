function login() {
    var data   = $('#auth-form').serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/login',
        data: data,
        type: "POST",
        success: function(data){
            if (data['result'] == 'success') {
                location.reload();
            }
            if (data['result'] == 'error'){
                showErrorLogin(data['message']);
            }
    },
    error:  function(xhr, str){
    }
});
}



function register() {
    var data   = $('#reg-form').serialize();
    if (!isValidEmailAddress($("#user_login-1").val())) {
        toastr.clear();
        toastr.error('Укажите реальный email', 'Ошибка!', {timeOut: 3000});
        return;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/register',
        data: data,
        type: "POST",
        success: function(data_resp){
            if (data_resp['result'] == 'success') {
                toastr.clear();
                toastr.success(data_resp['message'], 'Отлично!', {timeOut: 3000});
                return;
            }
            if (data_resp['result'] == 'error'){
                toastr.clear();
                toastr.error(data_resp['message'], 'Ошибка!', {timeOut: 3000});
                showErrorReg(data_resp['message']);
            }
        },
        error:  function(xhr, str){
            showErrorReg('Что-то пошло не так');
        },
        beforeSend : function (){
            toastr.clear();
            toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
        }
    });
}


function remember() {
    var data   = $('#forgot-form').serialize();
    if (!isValidEmailAddress($("#user_login_remember").val())) {
        toastr.clear();
        toastr.error('Укажите реальный email', 'Ошибка!', {timeOut: 3000});
        return;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: '/register',
        data: data,
        type: "POST",
        success: function(data_resp){
            if (data_resp['result'] == 'success') {
                toastr.clear();
                toastr.success(data_resp['message'], 'Отлично!', {timeOut: 3000});
                return;
            }
            if (data_resp['result'] == 'error'){
                toastr.clear();
                toastr.error(data_resp['message'], 'Ошибка!', {timeOut: 3000});
                showErrorReg(data_resp['message']);
            }
        },
        error:  function(xhr, str){
            showErrorReg('Что-то пошло не так');
        },
        beforeSend : function (){
            toastr.clear();
            toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
        }
    });
}



function callToAction() {
    var email = $('#callToActionEmail').val();

    if (email == null || email == "") {
        toastr.clear();
        toastr.error('Укажите свой email', 'Ошибка!', {timeOut: 3000});
        return;
    }
    if (!isValidEmailAddress(email)) {
        toastr.clear();
        toastr.error('Укажите реальный email', 'Ошибка!', {timeOut: 3000});
        return;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: '/register',
        data: { user_login: email , 'login-with-ajax': 'register'},
        type: "POST",
        success: function(data){
            console.log(data);
            if (data['result'] == 'success') {
                toastr.clear();
                toastr.success("Пароль отправлен на вашу почту", 'Отлично', {timeOut: 3000});
            }
            if (data['result'] == 'error'){
                toastr.clear();
                toastr.error(data['message'], 'Ошибка', {timeOut: 3000});
            }
            $('#callToActionEmail').val('');
        },
        error:  function(xhr, str){
            $('#callToActionEmail').val('');
        },
        beforeSend : function (){
            toastr.clear();
            toastr.info('Запрос обрабатывается', 'Внимание!', {timeOut: 3000});
            $('#callToActionEmail').val('');
        }
    });
}
