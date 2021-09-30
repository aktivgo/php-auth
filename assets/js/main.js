/*
    Authorization
 */

$('.login-btn').click(function (e){
    e.preventDefault();

    $(`input`).removeClass('error');

    let login = $('input[name = "login"]').val(),
        password = $('input[name = "password"]').val();

    $.ajax({
        url: 'includes/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success(data) {
            if(data.status){
                document.location.href = '../profile.php'
            } else{

                if(data.type === 1){
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });
                }

                $('.message').removeClass('none').text(data.message);
            }
        }
    });
});

/*
    Getting avatar from filed
 */

let avatar = false;

$('input[name="avatar"]').change(function (e){
    avatar = e.target.files[0];
});

/*
    Registration
 */

$('.register-btn').click(function (e){
    e.preventDefault();

    $(`input`).removeClass('error');

    let full_name = $('input[name = "full_name"]').val(),
        login = $('input[name = "login"]').val(),
        email = $('input[name = "email"]').val(),
        password = $('input[name = "password"]').val(),
        password_confirm = $('input[name = "password_confirm"]').val();

    let formData = new FormData();
    formData.append('full_name', full_name);
    formData.append('login', login);
    formData.append('email', email);
    formData.append('avatar', avatar);
    formData.append('password', password);
    formData.append('password_confirm', password_confirm);

    $.ajax({
        url: 'includes/signup.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success(data) {
            if(data.status){
                document.location.href = '../auth.php'
            } else{
                if(data.type === 1){
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });
                }
                $('.message').removeClass('none').text(data.message);
            }
        }
    });
});