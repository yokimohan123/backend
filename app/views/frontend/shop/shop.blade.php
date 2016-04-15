@include('partials.header')
@section('content')

<div class="content-container">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{URL::to('/')}}/">Home</a>
                <span class="gt">&rsaquo;</span>
            </li>
            <li><a href="{{URL::to('/')}}/shop">Shop</a>
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
                        <a href="<?php echo URL::to('/'); ?>/shop/{{$categories->slug}}">{{$categories->name}}</a>                
                    </li>
                @endforeach 
                    <li>
                        <h6>all</h6>
                    </li>
                @foreach($subcategories as $sub_cat)
                    @if($sub_cat->parent_id != 0)                
                        <li>
                            <a href="<?php echo URL::to('/'); ?>/shop/{{$sub_cat->slug}}">{{ $sub_cat->name }}</a>
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
                        <div class="dress-details">                            
                            <div class="dress-image">
                            @if(count($product['product_images']) > 1)
                                @if($product['new_tag'] == 1)
                                    <span class="new-label">New</span>
                                @elseif($product['sale_tag'] == 1)
                                    <span class="new-label-sale">Sale</span>
                                @endif
                                    <a href="{{URL::to('/')}}/shop/product_details/{{$product['id']}}">
                                        <img class="dress-out" src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$product['product_images'][0]['image_path']}}" >
                                        <img class="dress-hover" src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$product['product_images'][1]['image_path']}}" >
                                    </a>
                           
                            @elseif(count($product['product_images']) > 0)
                                @if($product['new_tag'] == 1)
                                    <span class="new-label">New</span>
                                @elseif($product['sale_tag'] == 1)
                                    <span class="new-label-sale">Sale</span>
                                @endif
                                <a href="{{URL::to('/')}}/shop/product_details/{{$product['id']}}">
                                    <img src="{{URL::to('/')}}/uploads/products/medium/{{$product['id']}}/{{$product['product_images'][0]['image_path']}}" >
                                </a>
                            @endif
                            <span class="sale">
                                <!-- <img src="images/sale.png" alt="sale"> -->
                            </span>

                            <!-- <div class="colors">
                                @foreach($product_attributes as $attributes)
                                    @foreach($attributes as $color)
                                        @if($product['id'] == $color['product_attribute_product_id'])
                                            @if($color['attribute_name'] == 'Color')
                                               <div style="background-color: {{$color['attribute_value_color']}}">
                                               </div>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            </div> -->
                            <!-- <a href="#" class="in-colors"></a> -->
                            </div>
                            <div class="dress-info-container">
                                <div class="dress-info">
                                    <a href="#" class="dress-name">{{$product['name']}}</a>
                                    <div class="dress-price">
                                        <span class="dress-original-price">
                                        <span class="currency">$</span>{{$product['original_price']}}</span>
                                    </div>
                                </div>
                                <div class="dress-info-hover">
                                    <a href="#" class="dress-name dress-name-hovered">{{$product['name']}}</a>
                                    <span class="dress-original-price">
                                        <span class="currency">$</span>{{$product['original_price']}}
                                    </span>
                                    <br /> 
                                    <!-- <a href="#" class="add-to-cart">Add to Cart</a> -->
                                </div>
                            </div>                            
                        </div>
                    </li>
                @endforeach
            @endif
            </ul>

            <div class="pagnation">
                @if($product_new->links() !='')
                 <label for="goto-page">View</label>
                <div class="pg-inner">
                    <span class="cus-arrow"></span>
                    <select name="goto-page" id="goto-page">
                        <option ></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>   
                @endif
                {{$product_new->links()}}         
            </div>
            <!--pagnation-->
        </div>       
    </div>     
</div>
<!--content-container-->
        

@include('partials.footer')