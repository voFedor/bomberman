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

