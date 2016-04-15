$(window).load(function() {
    $('.accordion-body:first-child').slideDown(400);
    $('.accordian_bdy').slideDown(400);
    $('.accordian_aro').addClass('accordion-open');
});
$(window).load(function() {
    $(".fabric-textures").mCustomScrollbar();
    $(".fabric-colors").mCustomScrollbar();

})

$(function() {

    // product info lightbox
    $('.product-info-img > a').colorbox({
        inline: true,
        width: "50%"
    });
    $('#tab3 .project_remove .product-suggestions-container .product-suggestions').jcarousel({
        animation: {
            duration: 300,
            easing: 'easeInSine'
        }
    });


    $(function() {
        var jcarousel = $('#tab3 .project_remove .product-suggestions-container .product-suggestions');

        jcarousel
            .on('#tab3 .project_remove .product-suggestions-container .product-suggestions jcarousel:reload jcarousel:create', function() {
                var width = jcarousel.innerWidth();

                console.log(width);

                if (width < 700 && width > 380) {
                    width = width / 2;
                } else if (width >= 600) {
                    width = width / 2.9;
                }
                /*else if (width >= 350) {
                                    width = width / 2;
                                }*/
                else if (width < 400) {
                    width = width / 1;
                }

                jcarousel.jcarousel('items').css('width', width + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('#tab3 .project_remove .product-suggestions-container .jcarousel-control-prev')
            .jcarouselControl({
                target: '-=3'
            });

        $('#tab3 .project_remove .product-suggestions-container .jcarousel-control-next')
            .jcarouselControl({
                target: '+=3'
            });

        $('#tab3 .project_remove .product-suggestions-container .product-suggestions .jcarousel-pagination')
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




    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });


})


// about alter project page slider.
$(window).load(function() {
    $('ul.banner1 li .imgover .imgover_close').click(function() {
        var $this = $(this);
        $this.parent('.imgover').fadeOut(1000);
        $this.parent('.imgover').parent('li').find('h2.option').css('left', '50px');
        $this.parent('.imgover').parent('li').find('h2.option').css('opacity', '1');


    });
    $('.project_remove ul li h2.option').click(function() {
        var $this = $(this);
        $this.next('.imgover').fadeIn(1000);
        $this.parent('li').find('h2.option').css('left', '250px');
        $this.parent('li').find('h2.option').css('opacity', '0');

    });
    // $('.project_remove ul li img').mouseenter(function() {
    //     $('.project_remove ul li h2.option').fadeIn(1000);
    //    });

});



//  project details page u might like slider.
$('#tab3 .projectcontainer .product-suggestions').jcarousel({
    animation: {
        duration: 800,
        easing: 'easeInSine'
    }
});

$(function() {
    var jcarousel = $('#tab3 .projectcontainer .product-suggestions');

    jcarousel
        .on('#tab3 .projectcontainer jcarousel:reload jcarousel:create', function() {
            var width = jcarousel.innerWidth();

            console.log(width);

            if (width < 700 && width > 380) {
                width = width / 2;
            } else if (width >= 600) {
                width = width / 4;
            }
            /*else if (width >= 350) {
                                width = width / 2;
                            }*/
            else if (width < 400) {
                width = width / 1;
            }

            jcarousel.jcarousel('items').css('width', width + 'px');
        })
        .jcarousel({
            wrap: 'circular'
        });

    $('#tab3 .projectcontainer .jcarousel-control-prev')
        .jcarouselControl({
            target: '-=1'
        });

    $('#tab3 .projectcontainer .jcarousel-control-next')
        .jcarouselControl({
            target: '+=1'
        });

    $('#tab3 .projectcontainer .jcarousel-pagination')
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

//  project details page recently viewed slider.
$(function() {
    var jcarousel = $('#tab3 .projectcontainer .recently-viewed');

    jcarousel
        .on('jcarousel:reload jcarousel:create', function() {
            var width = jcarousel.innerWidth();

            if (width < 700 && width > 380) {
                width = width / 2;
            } else if (width >= 600) {
                width = width / 4.1;
            }
            /*else if (width >= 350) {
                                width = width / 2;
                            }*/
            else if (width < 400) {
                width = width / 1;
            }

            jcarousel.jcarousel('items').css('width', width + 'px');
        })
        .jcarousel({
            wrap: 'circular'
        });

    $('#tab3 .projectcontainer .jcarousel-control-prev')
        .jcarouselControl({
            target: '-=1'
        });

    $('#tab3 .projectcontainer .jcarousel-control-next')
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

$('#tab3 .projectcontainer .recently-viewed').jcarousel({
    animation: {
        duration: 800,
        easing: 'linear'
    }
});
