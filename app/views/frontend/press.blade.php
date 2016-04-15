@include('partials.header')
@section('content')



<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}/">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/press">Press</a>
                    </li>
                </ul>
            </div>
            
                <div id="grid-gallery" class="grid-gallery">
                    
                <section class="grid-wrap">
                    <ul class="grid"> 
                       <li class="grid-sizer" ></li>
                       <?php foreach ($sliders as $press) { ?>
                        <li>
                            <figure>
                                <img src="{{URL::to('/')}}/uploads/press/small/{{ $press['image']}}" alt="<?php echo $press['alt']; ?>" title="<?php echo $press['title']; ?>"/>    
                            </figure>
                        </li> 
                        <?php } ?>
                    </ul> 
                </section><!-- // grid-wrap -->
                <section class="slideshow">
                    <ul>
                        <?php foreach ($sliders as $press) { ?>
                        <li>
                            <figure>    
                                <img src="{{URL::to('/')}}/uploads/press/medium/{{ $press['image']}}" alt="img01"/>
                            </figure>
                        </li>
                        <?php } ?>
                    </ul>
                    
                    <div class="arrow">
                        <span class="icon nav-prev"><img src="{{URL::to('/')}}/images/prev-collection.png"> </span>
                        <span class="icon nav-next"><img src="{{URL::to('/')}}/images/next-collection.png"></span>
                        <span class="icon nav-close"><img src="{{URL::to('/')}}/images/close.png"></span>
                    </div>
                    
                </section><!-- // slideshow -->
                            

            </div><!-- // grid-gallery -->
                <!--privacy-policy-->
        </div>
    </div>
</div>
    <!--container-->
    
    
    @include('partials.footer')