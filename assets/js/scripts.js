$(function() {
        console.log(window.location);
    // Ensure we're at the homepage
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
    }
});