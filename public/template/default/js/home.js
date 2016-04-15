
$(window).load(function(){
            $(".submenu-sidebar-details").mCustomScrollbar();
        });

$(function(){

   /* $('.navbar-mobile').on('click',function(){
        $(this).next('nav').slideToggle(600);
    })*/
    //---------- jQuery Cycle ----------------//
    $('.banner').cycle({
        loader: true,
        speed: 1500,
        timeout: 6000,
        next: '#arrow-up',
        prev: '#arrow-down',
        fx: 'fadeout'
    });

    /*var submenuDetails = $('.submenu-sidebar-details'),
    submenuDetailsAll = $('.submenu-sidebar-details').find('.all');
    $('nav > ul > li > a').mouseenter(function(){
        submenuDetailsAll.css('visibility','visible');
        $('.submenu-container').show();
        $(this).next('.submenu-lv1').stop().slideToggle(400,'easeInSine');
    }).mouseleave(function(){
        $(this).next('.submenu-lv1').delay(400).slideToggle(400,'easeOutSine');
    });
    $('.submenu-lv1').mouseenter(function(){
        $(this).stop(true,true);
    });
    $('.submenu-lv1').mouseleave(function(){
        $(this).slideToggle(400,'easeOutSine');
    });

    
    $('.submenu-sidebar a').mouseenter(function(){
        var $this = $(this),
        submenuAttr = $this.attr('data-prodcat');
        submenuDetails.find('li').hide();
        submenuDetails.find('.'+submenuAttr).css('visibility','visible');
        submenuDetails.find('.'+submenuAttr).show();
        
    }).mouseleave(function(){
        var $this = $(this),
        submenuAttr = $this.attr('data-prodcat');
        submenuDetails.find('li').hide();
        submenuDetails.find('.'+submenuAttr).css('visibility','visible');
        submenuDetails.find('.'+submenuAttr).show();
        
    })*/

    $('.item a').mouseenter(function(){
        $(this).find('.item-details').css({background:'rgba(75, 75, 75, 0.360784)',color: '#fff'}).next('.item-desc').css('opacity','1');
    }).mouseleave(function(){
        $(this).find('.item-details').css({background:'none',color: '#727272'}).next('.item-desc').css('opacity','0');
    });

    $("#bes_design").click(function(){
    $(".bespoke_design").show();
    $(".bespoke_reupholstery,.bespoke_furnicture").hide();
   
    });
    $("#bes_furniture").click(function(){
    $(".bespoke_furnicture").show();
    $(".bespoke_reupholstery,.bespoke_design").hide();
    
    });
    $("#bes_reupholstery").click(function(){
    $(".bespoke_reupholstery").show();
    $(".bespoke_design,.bespoke_furnicture").hide();
    
    });
})