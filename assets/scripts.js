$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault(); 
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: 'action/login.php', 
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                if (response == 'success') {
                    window.location.href = 'index';
                } else {
                    $('#error-message').html(response);
                }
            }
        });
    });


    $('#upload-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: 'action/upload_handler.php',
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false, 
            success: function(response) {
                $('#upload-message').html(response);
            },
            error: function(xhr, status, error) {
                $('#upload-message').html(error);
            }
        });
    });


});