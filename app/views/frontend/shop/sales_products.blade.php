@include('partials.header')
@section('content')

<div class="content-container">
	<div class="breadcrumb">
	    <ul>
	        <li><a href="{{URL::to('/')}}/">Home</a>
	            <span class="gt">&rsaquo;</span>
	        </li>
	        <li>
	        	<a href="{{URL::to('/')}}/sales">Shop</a>
	        	<span class="gt">&rsaquo;</span>
	        </li>
	        <li>
	        	<a href="#">{{$category->name}}</a>
	        </li>
	    </ul>
	</div>

	<div class="shop-container">
		<aside>
            <ul>
                <li>
                    <h6>collections</h6>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <a href="<?php echo URL::to('/'); ?>/sales/{{$category->slug}}">{{$category->name}}</a>                
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
			    @foreach ($products as $product)	        
			        <li>			        
			            <div class="dress-details">				            
			                <div class="dress-image">
			                @if(count($product['product_images']) > 0)
			                    <a href="{{URL::to('/')}}/sales/product_details/{{$product->id}}">
			                        <img src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$product['product_images'][0]['image_path']}}" >
			                    </a>
			                @endif
			                    <a href="#" class="in-colors"></a>
			                </div>
			                @if(count($product) > 0)
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
			                        <span class="dress-original-price">
			                            <span class="currency">$</span>{{$product['offer_price']}}</span>
                                        <span class="currency-offer">$</span><span class="currency-offer-price">{{$product['original_price']}}</span>
			                        </span>
			                        <input type="hidden" value="{{$product['original_price']}}" name="original_price" id="original_price">
			                        <input type="hidden" value="{{$product['offer_price']}}" name="discount_price" id="discount_price">
			                        <input type="hidden" value="{{$product['id']}}" name="product_id" id="product_id">
			                        <input type="hidden" value="1" name="quantity" id="quantity">
			                       	<input type="button" class="add-to-cart" value="Add to Cart">
			                    </div>
			                </div>
			              	@endif			                
			            </div>
			        </li>
			    @endforeach                   
		    </ul>		    
		</div>
	</div>
</div>
@include('partials.footer')