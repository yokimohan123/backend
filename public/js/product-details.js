

$('.accordion-heading h4').click(function(){
        var $this = $(this);
        $this.toggleClass('toggle-product-border').parent('span').next('.acc-body').slideToggle();
        $this.next('span').toggleClass('acc-open');
    })

var options = {  
            zoomType: 'standard',  
            lens:false,  
            preloadImages: true,  
            alwaysOn:false,  
            zoomWidth: 498,  
            zoomHeight: 498,  
            xOffset:10,  
            yOffset:0,  
            position:'left'  ,
            showEffect:'fadein',
            hideEffect:'fadeout'
    };  
    $('.jzoom').jqzoom(options);