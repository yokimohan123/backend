$(window).load(function(){
    $('.accordion-body:first-child').slideDown(400);
    $('.accordian_bdy').slideDown(400);
    $('.accordian_aro').addClass('accordion-open');
});
$(function(){
    $(".wishlist_product").hover(function() {
    $(this).children(".wishlist_close").fadeIn(200);
    });
    $(".wishlist_product").mouseleave(function() {
    $(this).children(".wishlist_close").fadeOut(200);
    });
    
});

$(function() {
        var jcarousel = $('.wishlist_recently-viewed');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var width = jcarousel.innerWidth();

                 if (width >= 1000) {
                    width = width / 5;
                }
                 else if (width < 1000 && width > 800){
                    width = width / 4;
                }
                else if (width < 800 && width > 600){
                    width = width / 3;
                }
                else if (width < 600 && width > 400){
                    width = width / 2;
                }
                 /*else if (width >= 350) {
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

    $('.wishlist_recently-viewed').jcarousel({
        animation: {
        duration: 800,
        easing:   'linear'
    }
    });
    
    $(document).on('click','.prjtacc_plus',function(){
        var $this = $(this),
        projectAccordion = $this.parents('.main_prjt');
        projectAccordion.clone().appendTo('.project1');

    })

    $(document).on('click','.prjtacc_minus',function(){
        var $this = $(this),
        projectAccordion = $this.parents('.main_prjt');
        projectAccordion.remove();

    })

    $(document).on('click','.accordion-heading h4',function(){
        var $this = $(this);
        $this.parent('span').next('.accordion-body').slideToggle();
        $this.parent('.accordion-heading').find('.accordion-arrow').toggleClass('accordion-open');
    })

    $(document).on('click','.accordion-arrow',function(){
        var $this = $(this);
        $this.parent('.accordion-heading').next('.accordion-body').slideToggle();
        $this.toggleClass('accordion-open');
    })

    $(document).on('click','.acc_plus',function(){
        var $this = $(this),
        accWishlist = $this.closest('.accordian_sub');
        accWishlist.clone().appendTo($this.closest('.project_body'));
    })

    $(document).on('click','.acc_minus',function(){
        var $this = $(this),
        accWishlist = $this.closest('.acc-wishlist');
        accWishlist.remove();
    })

    $(document).on('click','.project_heading h4',function(){
        var $this = $(this);
        $this.closest('.project_heading').next('.project_body').slideToggle(400);
    })