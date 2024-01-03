// Add active class to hoverable id element
$(document).ready(function() {
    $('li').hover(function() {
        $(this).addClass('active');
    }, function() {
        $(this).removeClass('active');
    });
});