@include('partials.header')
@section('content')

<div class="content-container">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{URL::to('/')}}/">Home</a>
                <span class="gt">&rsaquo;</span>
            </li>
            <li><a href="{{URL::to('/')}}/sales">Shop</a>
            </li>
        </ul>
    </div>
    <div class="shop-container">
        <aside>
            <ul>
                <li>
                    <h6>collections</h6>
                </li>
                @foreach ($category as $categories)
                    <li>
                        <a href="<?php echo URL::to('/'); ?>/sales/{{$categories->slug}}">{{$categories->name}}</a>                
                    </li>
                @endforeach 
                    <li>
                        <h6>all</h6>
                    </li>
                @foreach($subcategories as $sub_cat)
                    @if($sub_cat->parent_id != 0)                
                        <li>
                            <a href="<?php echo URL::to('/'); ?>/sales/{{$sub_cat->slug}}">{{ $sub_cat->name }}</a>
                        </li>
                    @endif
                @endforeach 
                <li><a href="#" id="sales">sales</a>
                </li>
                <li><a href="#" id="exclusives">exclusives</a>
                </li>
            </ul>
        </aside>
        <div class="collection">
            <ul>            
            @if(isset($products))           
                @foreach ($products as $product)
                    <li>          
                    <form action="#" method="post" id="product_cart">  
                        <input type="hidden" value="{{$product['original_price']}}" name="original_price">
                        <input type="hidden" value="{{$product['offer_price']}}" name="discount_price">
                        <input type="hidden" value="{{$product['id']}}" name="product_id">
                        <input type="hidden" value="{{$product['quantity']}}" name="quantity" id="quantity">                      
                        <div class="dress-details">                            
                            <div class="dress-image">
                            @if(count($product['product_images']) > 1)
                                @if($product['new_tag'] == 1)
                                    <span class="new-label">New</span>
                                @elseif($product['sale_tag'] == 1)
                                    <span class="new-label-sale">Sale</span>
                                @endif
                                    <a href="{{URL::to('/')}}/sales/product_details/{{$product['id']}}">
                                        <img class="dress-out" src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$product['product_images'][0]['image_path']}}" >
                                        <img class="dress-hover" src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$product['product_images'][1]['image_path']}}" >
                                    </a>
                                    <a href="#" class="in-colors"></a>
                           
                            @elseif(count($product['product_images']) > 0)
                                @if($product['new_tag'] == 1)
                                    <span class="new-label">New</span>
                                @elseif($product['sale_tag'] == 1)
                                    <span class="new-label-sale">Sale</span>
                                @endif
                                <a href="{{URL::to('/')}}/sales/product_details/{{$product['id']}}">
                                    <img src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$product['product_images'][0]['image_path']}}" >
                                </a>
                            @endif
                            </div>
                            <div class="dress-info-container">
                                <div class="dress-info">
                                    <a href="#" class="dress-name">{{$product['name']}}</a>
                                    <div class="dress-price">
                                        <span class="dress-original-price">
                                        <span class="currency">$</span>{{$product['offer_price']}}</span>
                                        <span class="currency-offer">$</span><span class="currency-offer-price">{{$product['original_price']}}</span>
                                    </div>
                                </div>
                                <div class="dress-info-hover">
                                    <a href="#" class="dress-name dress-name-hovered">{{$product['name']}}</a>
                                    <span class="currency">$</span>{{$product['offer_price']}}</span>
                                    <span class="dress-original-price">
                                        <span class="currency-offer">$</span><span class="currency-offer-price">{{$product['original_price']}}
                                    </span>
                                    <br /> <a href="#" class="add-to-cart">Add to Cart</a>
                                </div>
                            </div>                            
                        </div>                         
                    </form>
                    </li>
                @endforeach
            @endif
            </ul>

            
        </div>       
    </div>     
</div>
<!--content-container-->
        
@include('partials.footer')