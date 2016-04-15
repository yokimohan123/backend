$(window).load(function(){
    $('.accordion-body:first-child').slideDown(400);
    $('.accordian_bdy').slideDown(400);
    $('.accordian_aro').addClass('accordion-open');
});
$(window).load(function(){
    $(".fabric-textures").mCustomScrollbar();
    $(".fabric-colors").mCustomScrollbar();
    //$("#product-gallery-thumbs").mCustomScrollbar();
    // $('.accordion-body:first-child').slideDown(400);
    // $('.accordian_bdy').slideDown(400);
    // $('.accordian_aro').addClass('accordion-open');
})

$(function(){

    $('.cycle-slideshow').cycle({
        loader: true,
        speed: 0,
        timeout: 0,
        fx:'fadeout'
    });


    // product info lightbox
    $('.product-info-img > a').colorbox({inline:true,width:"50%"});

    $('.accordion-heading h4').click(function(){
        var $this = $(this);
        $this.toggleClass('toggle-product-border').parent('span').next('.accordion-body').slideToggle();
        $this.parent('.accordion-heading').find('.accordion-arrow').toggleClass('accordion-open');
    })


    $('.accordion-arrow').click(function(){
        var $this = $(this);
        $this.parent('.accordion-heading').next('.accordion-body').slideToggle();
        $this.toggleClass('accordion-open');
    })

    $('.product-suggestions').jcarousel({
        animation: {
        duration: 800,
        easing:   'easeInSine'
    }
    });


$(function() {
        var jcarousel = $('.product-suggestions');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var width = jcarousel.innerWidth();

                console.log(width);
                
                if (width < 700 && width > 380){
                    width = width / 2;
                }
                else if (width >= 600) {
                    width = width / 4.1;
                } /*else if (width >= 350) {
                    width = width / 2;
                }*/
                else if (width < 400) {
                    width = width / 1 ;
                }

                jcarousel.jcarousel('items').css('width', width + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });
    });


$(function() {
        var jcarousel = $('.recently-viewed');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var width = jcarousel.innerWidth();

                 if (width < 700 && width > 380){
                    width = width / 2;
                }
                else if (width >= 600) {
                    width = width / 4.1;
                } /*else if (width >= 350) {
                    width = width / 2;
                }*/
                else if (width < 400) {
                    width = width / 1 ;
                }

                jcarousel.jcarousel('items').css('width', width + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });
    });

    $('.recently-viewed').jcarousel({
        animation: {
        duration: 800,
        easing:   'linear'
    }
    });

    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });

     $('.goto-fabrics').colorbox({width: "96%",height: "96%"});
    $('.goto-fabrics').bind('cbox_complete',function(){
      $("#accordion").accordion();
      $('#cboxLoadedContent').find('.fabric_top').css('margin-top','20px');
      console.log('!!');
      /*$(window).scroll(function(){
        $(this).scrollTop(0);
      })*/

    });

    $('#cboxClose').click(function(){
        $(window).bind('scroll');
    })
})