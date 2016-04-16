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
        $('input').on('blur', function() {
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
                    case "email":
                        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if (regex.test(this.value) === false) {
                            $(this).parents('.form-group').addClass('has-error');
                            $(this).parents('.form-group').removeClass('passed-valid');
                            $(this).next('p').html('Not a valid email address');
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
                        } else {
                            $(this).parents('.form-group').removeClass('has-error');
                            $(this).parents('.form-group').addClass('passed-valid');
                            $(this).next('p').html('');
                        }
                        break;
                    default:
                        break;
                }
                console.log($('.passed-valid').length);
                if ($('.passed-valid').length === 4) {
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