$(document).ready(function(){
    $('.select-selected').css('color', '#b4b4b4');
    $('.select-selected').addClass('animated fadeIn');

    $('#email').keyup(function(){
        validateEmail($('#email'));
    });

    $('#password').keyup(function(){
        validatePassword($('#password'));
    });

    $('#confirmPassword').keyup(function(){
        validatePassConfirm($('#confirmPassword'));
    });

    $("#newPass").keyup(function() {
        validateNewPass($(this));
    });

    $("#confirmPass").keyup(function() {
        validateNewConfirmPass($("#newPass"), $(this));
    });
});

function pulseObject(e){
    var target = $(e);
    target.addClass('animated pulse fast');

    var removeAnim = function(){
        target.removeClass('animated pulse fast');
      };

    setTimeout(removeAnim, 800);
}

function validateEmail(input){
    var email = $(input).val();
    var regex = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

    var emailBox = $('#email-box');
    var emailValidIcon  = $("#email-valid-icon");
    var emailErrorIcon = $("#email-error-icon");
    var emailErrorDesc = $("#email-error");

    if(regex.test(email)){
        if(emailBox.hasClass('error-input')){
            emailBox.removeClass('error-input');
        }

        if(!emailErrorIcon.hasClass('hidden')){
            emailErrorIcon.addClass('hidden');
        }

        emailBox.addClass('valid-input');
        emailValidIcon.removeClass('hidden');
        emailErrorDesc.addClass('hidden');
    }
    else{
        if(emailBox.hasClass('valid-input')){
            emailBox.removeClass('valid-input');
        }

        if(!emailValidIcon.hasClass('hidden')){
            emailValidIcon.addClass('hidden');
        }

        emailBox.addClass('error-input');
        emailErrorIcon.removeClass('hidden');
        emailErrorIcon.addClass('animated flash slower infinite');

        emailErrorDesc.removeClass('hidden');
        emailErrorDesc.addClass('animated fadeIn');
    }
}

function validateUsername(input){
    var username = $(input).val();
    var usernameBox = $('#username-box');
    var usernameValidIcon  = $("#username-valid-icon");
    var usernameErrorIcon = $("#username-error-icon");
    var usernameErrorDesc = $("#username-error");

    if(username.length >= 6){
        if(usernameBox.hasClass('error-input')){
            (usernameBox).removeClass('error-input')
        }

        if(!usernameErrorIcon.hasClass('hidden')){
            usernameErrorIcon.addClass('hidden');
        }

        usernameBox.addClass('valid-input');
        usernameValidIcon.removeClass('hidden');
        usernameErrorDesc.addClass('hidden');
    }
    else{
        if(usernameBox.hasClass('valid-input')){
            (usernameBox).removeClass('valid-input')
        }

        if(!usernameValidIcon.hasClass('hidden')){
            usernameValidIcon.addClass('hidden');
        }

        usernameBox.addClass('error-input');
        usernameErrorIcon.removeClass('hidden');
        usernameErrorIcon.addClass('animated flash slower infinite');

        usernameErrorDesc.removeClass('hidden');
        usernameErrorDesc.addClass('animated fadeIn');
    }
}

function validatePassword(input){
    var password = $(input).val();
    var passwordBox = $('#password-box');
    var passwordValidIcon  = $("#password-valid-icon");
    var passwordErrorIcon = $("#password-error-icon");
    var passwordErrorDesc = $("#password-error");

    if(password.length >= 6){
        if(passwordBox.hasClass('error-input')){
            (passwordBox).removeClass('error-input')
        }
        if(!passwordErrorIcon.hasClass('hidden')){
            passwordErrorIcon.addClass('hidden');
        }

        passwordBox.addClass('valid-input');
        passwordValidIcon.removeClass('hidden');
        passwordErrorDesc.addClass('hidden');
    }
    else{
        if(passwordBox.hasClass('valid-input')){
            (passwordBox).removeClass('valid-input')
        }

        if(!passwordValidIcon.hasClass('hidden')){
            passwordValidIcon.addClass('hidden');
        }

        passwordBox.addClass('error-input');
        passwordErrorIcon.removeClass('hidden');
        passwordErrorIcon.addClass('animated flash slower infinite');

        passwordErrorDesc.removeClass('hidden');
        passwordErrorDesc.addClass('animated fadeIn');
    }
}


function validatePassConfirm(input){
    var password = $(input).val();
    var firstPass = $('#password').val();

    var passwordBox = $('#confirmPass-box');
    var passwordValidIcon  = $("#confirm-valid-icon");
    var passwordErrorIcon = $("#confirm-error-icon");
    var passwordErrorDesc = $("#confirmPassword-error");

    if((password == firstPass) && firstPass != ''){
        if(passwordBox.hasClass('error-input')){
            (passwordBox).removeClass('error-input')
        }

        if(!passwordErrorIcon.hasClass('hidden')){
            passwordErrorIcon.addClass('hidden');
        }

        passwordBox.addClass('valid-input');
        passwordValidIcon.removeClass('hidden');
        passwordErrorDesc.addClass('hidden');
    }
    else{
        if(passwordBox.hasClass('valid-input')){
            (passwordBox).removeClass('valid-input')
        }

        if(!passwordValidIcon.hasClass('hidden')){
            passwordValidIcon.addClass('hidden');
        }

        passwordBox.addClass('error-input');
        passwordErrorIcon.removeClass('hidden');
        passwordErrorIcon.addClass('animated flash slower infinite');

        passwordErrorDesc.removeClass('hidden');
        passwordErrorDesc.addClass('animated fadeIn');
    }
}

function validateNewPass(input) {
    var password = $(input).val();
    var passwordErrorDesc = $("#password-error-submit");

    if(password.length >= 6 ){
        if(!passwordErrorDesc.hasClass('hidden')) {
            passwordErrorDesc.addClass('hidden');
        }
    }
    else{
        passwordErrorDesc.removeClass('hidden');
    }
}

function validateNewConfirmPass(first, input) {
    var newpassword = $(first).val();
    var confirmpassword = $(input).val();
    var passwordErrorDesc = $("#password-incorrect");
    // if(confirmpassword.length < 6) {
    //     return;
    // }
    if(newpassword == confirmpassword){
        if(!passwordErrorDesc.hasClass('hidden')) {
            passwordErrorDesc.addClass('hidden');
        }
    }
    else{
        passwordErrorDesc.removeClass('hidden');
    }
}

//select-selected

$('#date-item-month').on('click',function(e){
    validateMonth();

});

function validateMonth(){
    var selectList = $('#date-month');

    if(selectList.val() != ""){
        $('#date-item-month').removeClass('error-input');
        $('#date-item-month').addClass('valid-input');
    }
    else{
        $('#date-item-month').removeClass('valid-input');
        $('#date-item-month').addClass('error-input');
    }
}

$('#date-item-day').on('click',function(e){
    validateDay();

});

function validateDay(){
    var selectList = $('#date-day');


    if(selectList.val() != ""){
        $('#date-item-day').removeClass('error-input');
        $('#date-item-day').addClass('valid-input');
    }
    else{
        $('#date-item-day').removeClass('valid-input');
        $('#date-item-day').addClass('error-input');
    }

}

$('#date-item-year').on('click',function(e){
    validateYear();

});

function validateYear(){
    var selectList = $('#date-year');

    if(selectList.val() != ""){
        $('#date-item-year').removeClass('error-input');
        $('#date-item-year').addClass('valid-input');
    }
    else{
        $('#date-item-year').removeClass('valid-input');
        $('#date-item-year').addClass('error-input');
    }

}

function validateTos(input){
    var checkBox = $('#tosBox');
    var checkBoxOverlay = $('#tosBoxOverlay');
    checkBox.prop("checked", !checkBox.prop("checked"));

    if(checkBox.is(':checked')){
        checkBoxOverlay.addClass('valid-input');

        if(checkBoxOverlay.hasClass('error-input')){
            checkBoxOverlay.removeClass('error-input');
        }
    }
    else{
        checkBoxOverlay.addClass('error-input');

        if(checkBoxOverlay.hasClass('valid-input')){
            checkBoxOverlay.removeClass('valid-input');
        }
    }
}

function validatePrivacy(input){
    var checkBox = $('#privacyBox');
    var checkBoxOverlay = $('#privacyBoxOverlay');
    checkBox.prop("checked", !checkBox.prop("checked"));

    if(checkBox.is(':checked')){
        checkBoxOverlay.addClass('valid-input');

        if(checkBoxOverlay.hasClass('error-input')){
            checkBoxOverlay.removeClass('error-input');
        }
    }
    else{
        checkBoxOverlay.addClass('error-input');

        if(checkBoxOverlay.hasClass('valid-input')){
            checkBoxOverlay.removeClass('valid-input');
        }
    }
}

function validateNewsLetter(input){
    var checkBox = $('#newsLetterBox');
    var checkBoxOverlay = $('#newsLetterBoxOverlay');
    checkBox.prop("checked", !checkBox.prop("checked"));

    if(checkBox.is(':checked')){
        checkBoxOverlay.addClass('valid-input');

        if(checkBoxOverlay.hasClass('neutral-input')){
            checkBoxOverlay.removeClass('neutral-input');
        }
    }
    else{
        checkBoxOverlay.addClass('neutral-input');

        if(checkBoxOverlay.hasClass('valid-input')){
            checkBoxOverlay.removeClass('valid-input');
        }
    }
}
