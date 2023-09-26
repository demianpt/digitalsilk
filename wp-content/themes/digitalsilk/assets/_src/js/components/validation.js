// myaccount validation

export default function validation() {
    if (jQuery('.login-wrapper').length) {
        const loginBtn = document.querySelector('.woocommerce-form-login__submit');
        const registerBtn = document.querySelector('.woocommerce-form-register__submit');
        const loginBtnWrapper = document.querySelector('.login .link-wrapper');
        const registerBtnWrapper = document.querySelector('.register .link-wrapper');

        jQuery(document).ready(() => {
            jQuery(loginBtnWrapper).addClass('disabled-wrapper');
            jQuery(registerBtnWrapper).addClass('disabled-wrapper');
            if ($(window).width() < 1023) {

                jQuery(loginBtnWrapper).before("<div class='validation-msg mobile-log'>Please, enter your login or email and password to login</div></br>");
                jQuery(registerBtnWrapper).before("<div class='validation-msg mobile-reg'>Please, enter your email and password to register</div></br>");

            }

        });

        function dissableBtnLogin() {
            if (jQuery('input#username').val().length === 0) {
                jQuery(loginBtn).attr('disabled', true);

            } else if (jQuery('.login input[type=password]').val().length === 0) {
                jQuery(loginBtn).attr('disabled', true);

            } else {
                jQuery(loginBtn).attr('disabled', false);
                jQuery(loginBtnWrapper).removeClass('disabled-wrapper');

            }

        }

        function dissableBtnRegister() {

            if (jQuery('input[type=email]').val().length === 0 || jQuery('.register input[type=password]').val().length === 0) {
                jQuery(registerBtn).attr('disabled', true);
            }

        }

        // Email mask validation
        function emailIsValid(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        // Functions for LOGIN validation
        function createMessages() {
            jQuery('input#username').after("<div class='validation-msg email-log hidden-msg'>Please, enter your login or email to login</div>");
            jQuery('.login input[type=password]').after("<div class='validation-msg password-log hidden-msg'>Please, enter your  password to login</div>");
            jQuery('input[type=email]').after("<div class='validation-msg email-reg hidden-msg'>Please, enter your  your email to register</div>");
            jQuery('.register input[type=password]').after("<div class='validation-msg password-reg hidden-msg'>Please, enter your  password to login</div>");
        }

        // Creating placeholders for the error messages
        jQuery(document).ready(() => {
            createMessages();
            if (jQuery('.woocommerce-form-login').length > 0) {
                dissableBtnLogin();
            }
            if (jQuery('.woocommerce-form-register').length > 0) {
                dissableBtnRegister();
            }
        });

        // function clickOndisabled() {
        //     // jQuery(loginBtn).attr("disabled", true) ? alert("diasbled") : alert("asbled");
        //     console.log(jQuery(loginBtn).attr("disabled") === true);
        // }

        function checkLoginEmail() {
            if (jQuery('input#username').val().length === 0) {
                jQuery('input#username').addClass('error-input');
                jQuery('.validation-msg.email-log').removeClass('hidden-msg').text('Please, enter login or email to login');
                jQuery(loginBtn).attr('disabled', true);
                jQuery(loginBtnWrapper).addClass('disabled-wrapper');
            } else {
                jQuery('.validation-msg.mobile-log').addClass('hidden-msg');
                jQuery('.validation-msg.email-log').addClass('hidden-msg');
                jQuery('input#username').removeClass('error-input');
                jQuery(loginBtn).attr('disabled', false);
                jQuery(loginBtnWrapper).removeClass('disabled-wrapper');
            }
        }

        function checkLoginPass() {
            if (jQuery('.login input[type=password]').val().length === 0) {
                jQuery('.login input[type=password]').addClass('error-input');
                jQuery('.validation-msg.password-log').removeClass('hidden-msg').text('Please, enter password to login');
                jQuery(loginBtn).attr('disabled', true);
                jQuery(loginBtnWrapper).addClass('disabled-wrapper');
            } else {
                jQuery('.validation-msg.mobile-log').addClass('hidden-msg');
                jQuery('.validation-msg.password-log').addClass('hidden-msg');
                jQuery('.login input[type=password]').removeClass('error-input');
                jQuery(loginBtn).attr('disabled', false);
                jQuery(loginBtnWrapper).removeClass('disabled-wrapper');
            }

        }

        function checkLogin() {
            checkLoginPass();
            checkLoginEmail();
        }

        // LOGIN VALIDATION

        jQuery(loginBtn).click((event) => {
            checkLogin();
        });

        jQuery(' .login input[type=password]').focusout(() => {
            checkLoginPass();
        });
        jQuery(' .login input[type=password]').keyup(() => {
            checkLoginPass();
        });

        jQuery('input#username').focusout(() => {
            checkLoginEmail();
        });
        jQuery('input#username').keyup(() => {
            checkLoginEmail();
        });

        // Register validation functions

        function checkRegisterEmail() {
            if (jQuery('input[type=email]').val().length === 0) {
                jQuery('.validation-msg.email-reg').removeClass('hidden-msg').text('Please, enter your email to register');
                jQuery('input[type=email]').addClass('error-input');
                jQuery(registerBtn).attr('disabled', true);

                jQuery(registerBtnWrapper).addClass('disabled-wrapper');
            } else {
                jQuery('.validation-msg.mobile-reg').addClass('hidden-msg');
                jQuery('.validation-msg.email-reg').addClass('hidden-msg');
                jQuery('input[type=email]').removeClass('error-input');
                jQuery(registerBtn).attr('disabled', false);
                jQuery(registerBtnWrapper).removeClass('disabled-wrapper');

            }
        }

        function validateRegisterEmail() {
            if (emailIsValid(jQuery('input[type=email]').val()) !== true) {
                jQuery('.validation-msg.email-reg').removeClass('hidden-msg').text('Please, enter correct email to register');
                jQuery('input[type=email]').addClass('error-input');
                jQuery(registerBtn).attr('disabled', true);
                jQuery(registerBtnWrapper).addClass('disabled-wrapper');
            } else {
                jQuery('.validation-msg.mobile-reg').addClass('hidden-msg');
                jQuery('.validation-msg.email-reg').addClass('hidden-msg');
                jQuery('input[type=email]').removeClass('error-input');
                jQuery(registerBtn).attr('disabled', false);
                jQuery(registerBtnWrapper).removeClass('disabled-wrapper');

            }
        }

        function checkRegisterPass() {
            if (jQuery('.register input[type=password]').val().length === 0) {
                jQuery('.register input[type=password]').addClass('error-input');
                jQuery('.validation-msg.password-reg').removeClass('hidden-msg').text('Please, enter your password to register');
                jQuery(registerBtn).attr('disabled', true);
                jQuery(registerBtnWrapper).addClass('disabled-wrapper');
            } else {
                jQuery('.validation-msg.mobile-reg').addClass('hidden-msg');
                jQuery('.validation-msg.password-reg').addClass('hidden-msg');
                jQuery('.register input[type=password]').removeClass('error-input');
                jQuery(registerBtn).attr('disabled', false);
                jQuery(registerBtnWrapper).removeClass('disabled-wrapper');

            }

        }

        function checkRegister() {

            checkRegisterEmail();
            validateRegisterEmail();
            checkRegisterPass();
        }

        jQuery(registerBtn).click((event) => {
            checkRegister();
        });

        jQuery('input[type=email]').focusout(() => {
            checkRegisterEmail();
            validateRegisterEmail();
        });
        jQuery('input[type=email]').keyup(() => {
            checkRegisterEmail();
        });
        jQuery('.register input[type=password]').focusout(() => {
            checkRegisterPass();
        });
        jQuery('.register input[type=password]').keyup(() => {
            checkRegisterPass();
        });

    }
}
