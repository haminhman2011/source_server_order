var Login = function() {
    var handleForgetPassword = function() {
        jQuery('#forget-password').click(function() {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    };

    return {
        //main function to initiate the module
        init: function() {

            handleForgetPassword();

        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});