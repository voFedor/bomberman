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
            if (data.result == true) {
                location.reload();
            }
            if (data.result == false){
                showErrorLogin(data.error);
            }
    },
    error:  function(xhr, str){
            console.log(xhr);
    }
});
}



function register() {
    var data   = $('#reg-form').serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/register',
        data: data,
        type: "POST",
        success: function(data){
            if (data.result == true) {
                showUserInfo(data.info);
            }
            if (data.result == false){
                console.log(data.error);
                showErrorReg(data.error);
            }
        },
        error:  function(xhr, str){
            console.log(xhr);
        }
    });
}



function callToAction() {
    var email = $('#callToActionEmail').val();
    if (email == null || email == "") {
        toastr.clear();
        toastr.error('Укажите свой email', 'Ошибка!', {timeOut: 3000})
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
            toastr.clear();
            toastr.success("Пароль отправлен на вашу почту", 'Отлично', {timeOut: 3000});
            if (data.result == true) {
                toastr.clear();
                toastr.success("Пароль отправлен на вашу почту", 'Отлично', {timeOut: 3000});
            }
            if (data.result == false){
                toastr.clear();
                toastr.error(data.error, 'Ошибка', {timeOut: 3000});
            }
        },
        error:  function(xhr, str){
            console.log(xhr);
        }
    });
}
