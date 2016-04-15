@include('partials.header')
@section('content')


<div class="content-container">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{URL::to('/')}}/">Home</a>
                <span class="gt">&rsaquo;</span>
            </li>
            <li><a href="{{URL::to('/')}}/frontend/collection">Collection</a>
            </li>
        </ul>
        
    </div>

</div>
<div class="">    
    <div class="gallery-collections">
    <!-- {{$i=0}} -->
        @foreach($collections as $collection)
         <!-- {{$i++}} -->
             <div>
                <h1 class="collection_title" style="color:{{$collection['color']}} ">{{$collection['title']}}</h1>
                <img data-related="main{{ $i}}" src="{{URL::to('/')}}/uploads/collections/cover/{{ $collection['id']}}/{{ $collection['image']}}" alt="{{ $collection['image']}}" title="{{ $collection['title']}}" width="436" height="654">
            </div> 
        @endforeach               
    </div>    
    <div class="slick-navigation"></div>
        <button class="back-collections">Back to collections</button>
            <div class="image-collection">  
            <!-- {{$i=0}} -->      
                @foreach($collections as $collection)
                <!-- {{$i++}} -->               
                <div id="main{{ $i}}" class="main-loop{{ $i}} commom-loop">
                    @foreach($collection['collection_images'] as $new_collectionKey => $new_collectionVal)
                        <div>
                            <img src="{{URL::to('/')}}/uploads/collections/large/{{ $new_collectionVal['collections_id']}}/{{ $new_collectionVal['image']}}"  width="436" height="654">
                            </div>  
                    @endforeach                                  
                </div>    
                <div class="nav-foor news_slider{{ $i}}"></div>
                @endforeach   
            </div>        
</div>
<!--content-container-->
<!-- {{$i=0}} -->
<script type="text/javascript">
$(document).ready(function (){
 @foreach($collections as $collection)
 <!-- {{$i++}} -->
    $('.main-loop<?php echo $i;?>').slick({
    centerMode: true,
    centerPadding: '0',
    slidesToShow: 4,
    cssEase: 'ease',
    arrows: true,
    appendArrows: $(".news_slider<?php echo $i;?>")
}); 

@endforeach  
});
</script>
@include('partials.footer')