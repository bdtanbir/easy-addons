
jQuery(document).ready(function ($) {
    // Perform AJAX login/register on form submit
    var loginicon = document.querySelector('#aduca-pop-login-submit');
    var registericon = document.querySelector('#aduca-pop-register-submit');
    jQuery('form#ua-login-register, form#ua-register-form').on('submit', function (e) {
        var curElement="#"+jQuery(this).attr('id');
        jQuery(curElement+' p.status', this).show().text(ajax_auth_object.loadingmessage);
        if (jQuery(this).attr('id') === 'ua-register-form') {
            action = 'ua_ajaxregister';
            username = jQuery('#reg-fname').val();
            username = jQuery('#reg-lname').val();
            username = jQuery('#reg-username').val();
            password = jQuery('#reg-password').val();
            password2 = jQuery('#reg-password2').val()
            email = jQuery('#reg-email').val();
            security = jQuery('#signonsecurity').val();
            ctrl = jQuery(this);
            registericon.innerHTML = '<i class="la la-refresh rotating"></i> Please Wait . . .';
            registericon.setAttribute("disabled", 'disabled')
            setTimeout(function() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_auth_object.ajaxurl,
                data: {
                    'action': action,
                    'username': username,
                    'password': password,
                    'password2': password2,
                    'email': email,
                    'security': security,
                },
                success: function (data) {
                    //console.log(curElement);
                    jQuery(curElement+' p.ua-login-register-msg-status').text(data.message);
                    if (data.loggedin == true) {
                        jQuery('.ua-login-register-msg-status').removeClass('loginerror');
                        jQuery('.ua-login-register-msg-status').addClass('loginsucess');
                        document.location.href = jQuery(ctrl).attr ('id') == 'register' ? ajax_auth_object.register_redirect : ajax_auth_object.redirecturl;
                    } else {
                        jQuery('.ua-login-register-msg-status').addClass('loginerror');
                        registericon.innerHTML = 'Register Account';
                        registericon.removeAttribute("disabled")
                    }
                }
            })},2000)
        }
        else{
            action = 'ua_ajaxlogin';
            username = 	jQuery('form#ua-login-register #username').val();
            password = jQuery('form#ua-login-register #password').val();
            security = jQuery('form#ua-login-register #security').val();
            ctrl = jQuery(this);
            loginicon.innerHTML = '<i class="la la-refresh rotating"></i> Please Wait . . .';
            loginicon.setAttribute("disabled", 'disabled')
            setTimeout(function() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_auth_object.ajaxurl,
                data: {
                    'action': action,
                    'username': username,
                    'password': password,
                    'security': security,
                },
                success: function (data) {
                    jQuery(curElement+' p.ua-login-register-msg-status').text(data.message);
                    if (data.loggedin === true) {
                        jQuery('.ua-login-register-msg-status').removeClass('loginerror');
                        jQuery('.ua-login-register-msg-status').addClass('loginsucess');
                        document.location.href = jQuery(ctrl).attr ('id') == 'register' ? ajax_auth_object.register_redirect : ajax_auth_object.redirecturl;
                    } else {
                        jQuery('.ua-login-register-msg-status').addClass('loginerror');
                        loginicon.innerHTML = 'Login Account';
                        loginicon.removeAttribute("disabled");
                    }
                }
            })},2000)
        }
        e.preventDefault();
    });
});