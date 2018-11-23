$(function(){
    
    $('ul.navbar-nav a.nav-link').click(function (event) {

        var s = $(this).attr('href');

        var o = $(s);

        if (o.length > 0) {
            var x = o.position().top;

            $('html, body').stop().animate({scrollTop: x}, 1000);

            event.preventDefault();
        }

    });


    $('.btn-collapse').click(function () {
        $("#collapseTabs .collapse").removeClass('show');
        $('.btn-collapse').removeClass('btn-current');

        $(this).addClass('btn-current');
        var s = $(this).attr('data-target');
        $(s).addClass('show');
    });
    
    
});