@include('partials.header')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
@section('content')
	<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/sales">Shop</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="<?php echo URL::to('/').'/'.'sales'.'/'.'product_details'.'/'.$product['id'];?>">Details</a>
                    </li>
                </ul>
            </div>
            <div class="shop-container">
                <div class="product-gallery-container">
                    <div class="product-gallery">
                        <a href="{{URL::to('/')}}/uploads/products/temp/{{$product['id']}}/{{$product['product_images'][0]['image_path']}}" data-lightbox="scarlet" class="jzoom" rel="product-gallery">
                            <img src="{{URL::to('/')}}/uploads/products/large/{{$product['id']}}/{{$product['product_images'][0]['image_path']}}" alt="">
                        </a>
                        <ul class="product-gallery-thumbnails">
                            {{-- */$i=0;/* --}}
                            @foreach($product['product_images'] as $psk => $psv)
                                {{-- */$i=$i+1;/* --}}
                                @if($i == 1)
                                    {{-- */$active = "zoomThumbActive";/* --}}
                                @else
                                    {{-- */$active = "";/* --}}
                                @endif
                                <li>                           
    	                           <a class="{{$active}}" href="javascript:void(0);" rel="{gallery: 'product-gallery', smallimage: '{{URL::to('/')}}/uploads/products/large/{{$product['id']}}/{{$psv['image_path']}}',largeimage: '{{URL::to('/')}}/uploads/products/temp/{{$product['id']}}/{{$psv['image_path']}}'}">
    	                               <img src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$psv['image_path']}}">
    	                           </a>	                           
                                </li>       
                            @endforeach                    
                        </ul>
                    </div>
                </div>
                <!--product-gallery-container-->
                <div class="product-details-container">
                    <h3><b>{{$product['name']}}</b></h3>
                    <span class="product-original-price">${{$product['original_price']}}</span>
                    <span class="product-discount-price">${{$product['offer_price']}}</span>
                    <div class="product-description">
                        <span class="accordion-heading">
                            <h4>description</h4>
                            <span class="acc-close"></span>
                        </span>
                        <p class="acc-body">
                        	{{$product['description']}}
                        </p>
                    </div>
                    <div class="product-specific-details">
                        <span class="accordion-heading">
                            <h4>specific details</h4>
                            <span class="acc-close"></span>
                        </span>
                        <span class="acc-body">
                            <ul class="specific-details">
                                <li>
                                    <span class="sd-attr">Style</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Fabric Composition</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Neckline</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Sleeve Length</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Measurements</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Occasion</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Season</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Package Contents</span>
                                    <span class="sd-value"></span>
                                </li>
                                <li>
                                    <span class="sd-attr">Washing &amp; Care</span>
                                    <span class="sd-value"></span>
                                </li>
                            </ul>
                        </span>
                    </div>
                    <div class="size-fit-guide">
                        <span class="accordion-heading">
                            <h4>size &amp; fit guide</h4>
                            <span class="acc-close"></span>
                        </span>
                        <p class="acc-body">
						{{$product['short_description']}}                        
						</p>
                    </div>  
                    <div class="share">
                        <label for="share">Share:</label>
                        <ul id="share">
                            <li>
                                <a href="<?php echo $footer[0]['link']; ?>"  target="_blank">
                                    <img src="{{URL::to('/')}}/images/facebook.png" alt="Facebook" width="32">
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $footer[3]['link']; ?>"  target="_blank">
                                    <img src="{{URL::to('/')}}/images/twitter.png" alt="Twitter" width="32">
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $footer[4]['link']; ?>"  target="_blank">
                                    <img src="{{URL::to('/')}}/images/instagram.png" alt="Twitter" width="32">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="user-specs">
                        <form action="#" method="post" id="product_cart">
                            <input type="hidden" value="{{$product['offer_price']}}" name="offer_price">
                            <input type="hidden" value="{{$product['id']}}" name="product_id">
                            <ul>
                                <li>       
                                @if(!$product_attributes =='')                         
                                    <label for="size">Size:</label>
                                    <span class="cus-arrow pd-arrow"></span>
                                    <select name="size" id="size">
	                                    @foreach($product_attributes as $attributes_key => $attributes_val)
	                                   		@if($attributes_val['attribute_name'] == 'Size')
	                                        <option value="{{$attributes_val['attribute_value_name']}}">{{$attributes_val['attribute_value_name']}}</option>                                        
										    @endif
	                                	@endforeach                                        
                                    </select>  
                                 @endif                                 
                                </li>
                           
                                <li>   
                                 @if(!$product_attributes =='')                                          
                                    <label for="color">Color:</label>
                                    <span class="cus-arrow pd-arrow"></span>
                                    <select name="color" id="color">
	                                    @foreach($product_attributes as $attributes_key => $attributes_val)
	                                 		@if($attributes_val['attribute_name'] == 'Color')
	                                        <option value="{{$attributes_val['attribute_value_name']}}">{{$attributes_val['attribute_value_name']}}</option>                                       
	                                    	@endif
	                                  	@endforeach    
                                    </select> 
                                 @endif                                                
                                </li>
                                <li>
                                    <label for="quantity">Quantity:</label>
                                    <span class="cus-arrow pd-arrow"></span>
                                    <select name="quantity" id="quantity">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </li>
                                <li>
                                    <p id="cart_success">Added to cart successfully. <a href="{{URL::to('/')}}/cart/view">View Cart</a></p>
                                    <input type="button" id="add_to_cart" value="add to cart" class="addtocart">
                                </li>
                                <li>
                                    <input type="submit" name="add_to_wishlist" value="add to wishlist" class="addtowishlist">
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>

        </div>
@include('partials.footer')