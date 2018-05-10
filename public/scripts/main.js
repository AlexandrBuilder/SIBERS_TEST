//write error after input
var printErrorForm = function(th, message) {
    $(th).addClass('novalid');
    th.after(message);
};

//remove error after input
var deleteErrorForm = function(th) {
    $(th).removeClass('novalid');
    if ($(th).next('.error-valid')[0]) 
        $(th).next('.error-valid')[0].remove();
};

//set validation forms
var inputValidation = function(th) {
    var password = $('.registration input[type=password]');
    if ($(th).val()) {
        deleteErrorForm(th);
        if ($(th).attr('type') == 'password') {
            if ($(th).val().length < 8 || $(th).val().length > 200) {
                printErrorForm($(th), '<span class="error-valid">Поле «' + $(th).prev().text() + '» должно быть не менее 8 символов и не более 200</span>');
            } else {
                if ($(th)[0] == password[1] && password[0].value) {
                    if (password[0].value != password[1].value) 
                    	printErrorForm($(password[1]), '<span class="error-valid">Пароли не совпадают</span>');
                } else {
                    if ($(th)[0] == password[0] && password[1].value) {
                        if (password[0].value != password[1].value) {
                            deleteErrorForm($(password[1]));
                            printErrorForm($(password[1]), '<span class="error-valid">Пароли не совпадают</span>');
                        }
                    }
                }
            }
        }

        if (($(th).attr('id') == "first-name") || ($(th).attr('id') == "second-name") || ($(th).attr('id') == "middle-name")) {
            if ($(th).val().length < 2 || $(th).val().length > 30) {
                printErrorForm($(th), '<span class="error-valid">Поле «' + $(th).prev().text() + '» должно быть не менее 2 символов и не более 30</span>');
            } else if (!$(th).val().search(/^[a-zа-я]+$/i) == 0) {
                printErrorForm(th, '<span class="error-valid">Поле «' + $(th).prev().text() + '» должно содержать символы а-я и a-z</span>');
            }
        }

        if (($(th).attr('id') == "login")) {
            if ($(th).val().length < 5 || $(th).val().length > 100) {
                printErrorForm($(th), '<span class="error-valid">Поле «' + $(th).prev().text() + '» должно быть не менее 5 символов и не более 100</span>');
            }
        }

    } else {
        deleteErrorForm(th);
        printErrorForm($(th), '<span class="error-valid">Поле «' + $(th).prev().text() + '» должно быть заполнено</span>');
    }
};

//set validation for changes in the forms radio
var radioValidation = function() {
    deleteErrorForm($('.radio-group'));
    if ($('input[type=radio]:checked').length <= 0) {
        printErrorForm($('.radio-group'), '<span class="error-valid">Пол должен быть указан </span>');
        return false;
    }
    return true;
}

//set validation for changes in forms and click to submit
var inputEvent = function() {

    $('.registration input.required').on('change focusout', function() {
        inputValidation($(this));
    });

    $('.registration input[type=submit]').on('click', function() {
        var error = true;
        $('.registration input.required').each(function() {
            inputValidation($(this));
            if ($(this).next('.error-valid').length || !$(this).val()) 
                error = false;
        });
        if ($('input[type=radio]').length > 0)
            error = radioValidation() && error;
        return error;
    });
};

//start the script when the page load
$(document).ready(function() {

    inputEvent();

    //set the behavior of the password field when editing
    $('.edit input[type=password]').on('change focusout', function() {
          var empty = 0 ;

        if($(this).val()) {
            $('.edit input[type=password]').each(function() {
                $(this).addClass('required');
                inputValidation($(this));
            });
        }

        $('.edit input[type=password]').each(function() {
            empty = $(this).val().length || empty;
        });

        if (!empty) {
            $('.edit input[type=password]').each(function() {
                deleteErrorForm(this);
                $(this).removeClass('required');
            });
        }
    });

    //check for the login in the ВD
    $('.edit input[name=login], .add-form input[name=login]').on('focusout',function (e) {
        e.preventDefault();
        var json;
        var th = $(this);
        var id = th.data('id');
        var login = th.val();
       $.ajax({
            url:'/admin/user',
            data:{login:login, id:id},
            type:'POST',
            success: function(result) {
                json = jQuery.parseJSON(result);
                console.log(json);
                if(json.message == false) {
                    deleteErrorForm(th);
                    printErrorForm($(th), '<span class="error-valid">Этот логин уже занят</span>');
                }
            },
        });
    });
});