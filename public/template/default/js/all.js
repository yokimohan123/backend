$(window).load(function() {
    $('.submenu-lv1').css('width',$('.nav-container > nav').width()*0.98);
    $(".submenu-sidebar-details").mCustomScrollbar();
    var res = $('.logo').height(),
    distance = $('.nav-container > nav').offset().top;
    $window = $(window),
    navbar = $('.nav-container');
    $window.scroll(function(){
        if($window.scrollTop() > distance)
            navbar.addClass('navbar-fixed');
        else
            navbar.removeClass('navbar-fixed');
    })
});

$(function() {

    $('.navbar-mobile').on('click', function() {
        $(this).next('nav').slideToggle(600);
    })

    var submenuDetails = $('.submenu-sidebar-details'),
        submenuDetailsAll = $('.submenu-sidebar-details').find('.all'),
        submenuActive;
    $('nav > ul > li > a').mouseenter(function() {
        var $this = $(this);
        submenuActive = $this.attr('data-submenu');
        $('.submenu-lv1').hide(100);
        $('.'+submenuActive).slideToggle(400);
    });
    $('.submenu-lv1').mouseleave(function() {
        $(this).hide();
    });


    $('.submenu-sidebar a').mouseenter(function() {
        var $this = $(this),
            submenuAttr = $this.attr('data-prodcat');
        submenuDetails.find('li').hide();
        submenuDetails.find('.' + submenuAttr).css('visibility', 'visible');
        submenuDetails.find('.' + submenuAttr).show();

    }).mouseleave(function() {
        var $this = $(this),
            submenuAttr = $this.attr('data-prodcat');
        submenuDetails.find('li').hide();
        submenuDetails.find('.' + submenuAttr).css('visibility', 'visible');
        submenuDetails.find('.' + submenuAttr).show();

    });
   
});

