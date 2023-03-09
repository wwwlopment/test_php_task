$(function () {
    'use strict';
    const forms = $('.requires-validation');
    const inputs = {
        password: $('#password'),
        confirmPassword: $('#confirmPassword')
    };
    const errorMessages = {
        password: $('#password-error'),
        confirmPassword: $('#confirmPassword-error')
    };

    function validatePasswordMatch() {
        if (inputs.password.val() !== inputs.confirmPassword.val()) {
            inputs.confirmPassword[0].setCustomValidity('Passwords do not match');
        } else {
            inputs.confirmPassword[0].setCustomValidity('');
            errorMessages.confirmPassword.text('');
        }
    }

    function handleInvalid(event) {
        errorMessages[event.target.id].text(event.target.validationMessage);
    }

    function handleInput(event) {
        errorMessages[event.target.id].text('');
        event.target.checkValidity();

        if (errorMessages.confirmPassword.text()) {
            validatePasswordMatch();
        }
    }

    inputs.password.on('invalid', handleInvalid);
    inputs.confirmPassword.on('invalid', handleInvalid);

    inputs.password.on('input', handleInput);
    inputs.confirmPassword.on('input', handleInput);

    forms.each(function () {
        $(this).on('submit', function (event) {
            event.preventDefault();
            errorMessages.password.text('');
            errorMessages.confirmPassword.text('');
            validatePasswordMatch();

            if (!this.checkValidity()) {
                event.stopPropagation();
            } else {
                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: '/',
                    data: $("form").serialize(),
                    success: function (response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            $(".form-items").hide().fadeOut(600);
                            $("#registeredSuccess").show().fadeIn(600);
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function (jqXHR, exception) {
                        if (jqXHR.status === 0) {
                            toastr.error('Not connect. Verify Network.');
                        } else if (jqXHR.status === 404) {
                            toastr.error('Requested page not found (404).');
                        } else if (jqXHR.status === 500) {
                            toastr.error('Internal Server Error (500).');
                        } else if (exception === 'parsererror') {
                            toastr.error('Requested JSON parse failed.');
                        } else if (exception === 'timeout') {
                            toastr.error('Time out error.');
                        } else if (exception === 'abort') {
                            toastr.error('Ajax request aborted.');
                        } else {
                            toastr.error('Uncaught Error. ' + jqXHR.responseText);
                        }
                    }
                });
            }
            this.classList.add('was-validated');
        });
    });
    toastr.options = {
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar": true,
        "timeOut": 2000
    }
});
