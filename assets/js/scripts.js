$(function() {
    
    if (window.location.pathname === '/')
    {
        // Onclick for each stock summary row takes the text
        // from the first cell and appends it to the /stockhistory/
        // link & redirects
        $('.stock-summary-row').click(function(){
            var url = window.location.origin + '/stockhistory/'
                + jQuery(this).children('td:first').text();
            window.location.href = url;
        });
        
        // Same as with stock-summary
        $('.player-summary-row').click(function(){
            var url = window.location.origin + '/profiles/'
                + jQuery(this).children('td:first').text();
            window.location.href = url;
        });
    } else if (window.location.pathname === '/register')
    {
        $('#content input').on('blur', function() {
            if (this.value === "" || this.value === null) {
                $(this).parents('.form-group').addClass('has-error');
                $(this).parents('.form-group').removeClass('passed-valid');
                $(this).next('p').html('Must not be blank');
            } else {
                switch(this.id) {
                    case "username":
                        if (this.value.length < 5) {
                            $(this).parents('.form-group').addClass('has-error');
                            $(this).parents('.form-group').removeClass('passed-valid');
                            $(this).next('p').html('Minimum 5 characters');
                        } else {
                            $(this).parents('.form-group').removeClass('has-error');
                            $(this).parents('.form-group').addClass('passed-valid');
                            $(this).next('p').html('');
                        }
                        break;
                    case "password":
                        if (this.value.length < 5) {
                            $(this).parents('.form-group').addClass('has-error');
                            $(this).parents('.form-group').removeClass('passed-valid');
                            $(this).next('p').html('Minimum 5 characters');
                        } else if ($(this).val() !== $('#password-confirm').val()
                                && $('#password-confirm').parents('.form-group').hasClass('passed-valid')) {
                            $(this).parents('.form-group').addClass('has-error');
                            $(this).parents('.form-group').removeClass('passed-valid');
                            $(this).next('p').html('Passwords must match');
                        } else {
                            $(this).parents('.form-group').removeClass('has-error');
                            $(this).parents('.form-group').addClass('passed-valid');
                            $(this).next('p').html('');
                        }
                        break;
                    case "password-confirm":
                        if (this.value.length < 5) {
                            $(this).parents('.form-group').addClass('has-error');
                            $(this).parents('.form-group').removeClass('passed-valid');
                            $(this).next('p').html('Minimum 5 characters');
                        } else if ($(this).val() !== $('#password').val()
                                && $('#password').parents('.form-group').hasClass('passed-valid')) {
                            $(this).parents('.form-group').addClass('has-error');
                            $(this).parents('.form-group').removeClass('passed-valid');
                            $(this).next('p').html('Passwords must match');
                        } else {
                            $(this).parents('.form-group').removeClass('has-error');
                            $(this).parents('.form-group').addClass('passed-valid');
                            $(this).next('p').html('');
                        }
                        break;
                    default:
                        break;
                }
                if ($('.passed-valid').length === 3) {
                    $('#btn-submit').prop('disabled', false);
                    $('#btn-submit').addClass('btn-success');
                } else {
                    $('#btn-submit').prop('disabled', true);
                    $('#btn-submit').removeClass('btn-success');
                }
            }
        });
    }
});