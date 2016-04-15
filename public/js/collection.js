
$('.gallery-collections').slick({
    centerMode: true,
    centerPadding: '0',
    slidesToShow: 3,
    cssEase: 'ease',
    onAfterChange: function() {
        $('.slick-slide img').mouseleave();
        $('.slick-center img').mouseenter();
    }
});
$('.slick-center').addClass('colored');
console.log($(window).width());



