
function preview(token){
    $.getJSON("//ulogin.ru/token.php?host=http://disput.fun&token=" + token + "&callback=?",
        function(data){

            data=$.parseJSON(data.toString());

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/ulogin',
                    type: "POST",
                    data: data,
                    success: function(data) {
                        toastr.clear()
                        toastr.success(data['message'], 'Отлично', {timeOut: 5000});
                        window.location.href = "/";
                    },
            });



            if(!data.error){
                alert("Привет, "+data.first_name+" "+data.last_name+"!");
            }
        });
}







function checkRegForm() {
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();

    if (name == "" || email == "" || password == "") {
        toastr.clear();
        toastr.error("", 'Заполните все поля', {timeOut: 5000});
        return;
    }
    else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/register',
            type: "POST",
            data: $('#regForm').serialize(),
            success: function(data) {
                window.location.href = "/";
            },
        });
    }
}



function checkLoginForm() {
    var email = $("#email").val();
    var password = $("#password").val();

    if (email == "" || password == "") {
        toastr.clear();
        toastr.error("", 'Заполните все поля', {timeOut: 5000});
        return;
    }
    else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/login',
            type: "POST",
            data: $('#loginForm').serialize(),
            success: function(data) {
                window.location.href = "/";
            },
        });
    }
}
