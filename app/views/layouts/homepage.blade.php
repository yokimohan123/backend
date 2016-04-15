@include('partials.header')
@section('content')        
    
    
    <div class="banner-container">
        <div class="slideshow-cycle" data-cycle-swipe=true data-cycle-swipe-fx=scrollHorz data-cycle-prev=".prev" data-cycle-next=".next" data-cycle-caption="#alt-caption" data-cycle-caption-template="<?php echo '{{alt}}'.'<br/>'.'<span>'.'{{VIEW COLLECTION}}'.'</span>';?>">
        <?php if(count($sliders) > 0 ){ ?>
            <?php foreach ($sliders as $slide) { ?>        
                <img src="{{URL::to('/')}}/uploads/home/slider/<?php echo $slide['image']; ?>" alt="<?php echo $slide['alt']; ?>" title="<?php echo $slide['title']; ?>" data-link ="<?php echo $slide['link']; ?>" class="homepage_banner_slider" data-season="<?php echo $slide['title']; ?>" data-month="<?php echo date('m/d',strtotime($slide['month'])); ?>" data-tint="light">
            <?php } ?>
        <?php } ?>
        </div>
        <div id="alt-caption" class="light"></div>
        <div class="banner-nav-container">
            <div class="banner-nav">
                <div class="season"></div>
                <span id="arrow-up">
                    <img src="images/arrow-up.png" alt="arrow up">
                </span>
                <span id="arrow-down">
                    <img src="images/arrow-down.png" alt="arrow down">
                </span>
                <div class="month"></div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function (){
    var seasonText = $('.season');
    var monthText = $('.month');
    var captionClass = $('#alt-caption');
    var viewClass = $('.vc');
    var cls, season, month, cycleActive;
    $('.slideshow-cycle').on('cycle-after', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
        var $this = $(this);
        cycleActive = $this.find('.cycle-slide-active');
        season = cycleActive.attr('data-season');
        month = cycleActive.attr('data-month');
        seasonText.html(season);
        monthText.html(month);
        //console.log(outgoingSlideEl);
        cls = cycleActive.attr('data-tint');
        if (cls == 'light') {
          $("#alt-caption").css("color", "#deb887");
        }
    })

});
</script>
@include('partials.footer')


     