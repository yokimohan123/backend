$(function() {

    //---------- jQuery Cycle ----------------//
    $('.slideshow-cycle').cycle({
        loader: true,
        speed: 1500,
        timeout: 6000,
        next: '#arrow-up',
        prev: '#arrow-down',
        fx: 'fadeout'
    });

    //---------- navbar-mobile ------------//

    $('.navbar-mobile').on('click', function() {
        $('nav > ul').slideToggle();
    });

    //---------- banner ------------------//

    
    $('nav > ul > li > a').mouseover(function() {
        var $this = $(this);
        $this.next('.submenu-lv1').addClass('submenu-active');
        return false;
    }).mouseout(function() {
        var $this = $(this);
        $this.next('.submenu-lv1').removeClass('submenu-active');
        return false;
    })

    $('.submenu-lv1').mouseover(function() {
        $(this).addClass('submenu-active');
        return false;
    })

    $('.submenu-lv1').mouseout(function() {
        $(this).removeClass('submenu-active');
    })

    //-------------- shop dress-info add to cart ------------------------//

    $('.dress-details').mouseover(function() {
        $(this).find('.dress-info-hover').stop(true, true).animate({
            marginTop: '-54px'
        });
    }).mouseleave(function() {
        $(this).find('.dress-info-hover').animate({
            marginTop: '20px'
        });
    });
    $('.dress-details').hover(function() {
            $(this).find('.in-colors').slideToggle();
        })
        //--------------  cart ------------------------//

    // $('#change_adrs').iCheck({
    //     radioClass: 'checked'
    // });


    // $('#change_adrs').on('ifChecked',function(){
    //      $('#shp_adr').show();
    //      $('.profile_address').hide();
    //  }).on('ifUnchecked',function(){
    //      $('.profile_address').show();
    //      $('#shp_adr').hide();
    //  })


    $("#login_pw").click(function() {
        $(".forgot_pw").show()
        $(".login").hide()
    });


    $("#pw_submit").click(function() {
        $(".we_sent").show()
        $(".forgot_pw").hide()
        $(".we_sent").fadeOut(2000)
        $(".login").delay(2001).fadeIn()
        $("#login_pw").hide()

    });
    // $(".currency_submit,#nav_shipping").click(function() {
    //     $(".shopping_cart,.payment,.confirmation").hide()
    //     $(".shipping").show()

    // });
    // $(".shipping_submit,#nav_payment").click(function() {
    //     $(".shipping,.shopping_cart,.confirmation").hide()
    //     $(".payment").show()
    // });
    // $(".payment_submit,#nav_confirm").click(function() {
    //     $(".payment,.shipping,.shopping_cart").hide()
    //     $(".confirmation").show()
    // });
    // $("#nav_cart").click(function() {
            //     $(".payment,.shipping,.confirmation").hide()
            //     $(".shopping_cart").show()
            // });


    $("#cart_close").click(function() {
        $(".cart_row li").css('visibility', 'hidden');

    });

    $('input').iCheck({
        // checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'

        // increaseArea: '20%' // optional
    });

    $("#cnform_close").click(function() {
        $(".cart_row li").css('visibility', 'hidden');

    });

});

$(document).ready(function($) {
    $("#nav li").find("a[href='" + window.location.href + "']").each(function() {
        $(this).addClass("menu-active");
    })
});
