@include('partials.header')
@section('content')
		<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/cart/view">Cart</a>
                    </li>
                </ul>
            </div>
            <!-- Shopping cart -->
            <div class="shopping_cart">
                <div class="cart_navbar">
                    <ul>
                        <li><a href="">Back to Shopping</a>
                        </li>
                        <li class="cart_active" id="nav_cart">
                        <h1 class="text-shop">1</h1>
                        <p class="text-background">Shopping Cart</p></li>
                        <li id="nav_shipping">2. Shipping</li>
                        <li id="nav_payment">3. Payment</li>
                        <li id="nav_confirm">4. Confirmation</li>
                    </ul>
                </div>
                <div class="cart_table">
                    <p id="cart_p">SHOPPING CART</p>
                    @if(Session::has('item_deleted'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <p>{{Session::get('item_deleted')}}</p>
                    </div>
                    @endif
                    <div class="cart_head">
                        <ul>
                            <li>Item</li>
                            <li>Quantity</li>
                            <li>Colour</li>
                            <li>Size</li>
                            <li>Price</li>
                            <li>Remove</li>
                        </ul>
                    </div>
                    <div class="cart_row">
                        <div class="cart_row_algn">
                           	@if(count($cart_items)>0)
	                           	@foreach($cart_items as $items)
	                           	<ul>
		                          	<li>
		                          	    <img src="{{URL::to('/')}}/uploads/products/original/{{$items['id']}}/{{$items['options']['image']}}" width="82px" height="118px">
		                          	    <p>{{$items['name']}}</p>
		                          	</li>
		                          	<li>{{$items['qty']}}</li>
                                    @if($items['options']['color'] > 0)
		                          	<li class="color_shoppingcart" style="background-color:{{$items['options']['color'][0]}} "></li>
                                    @else
                                        <li class="color_text_shoppingcart">No colors Available for this product.</li>
                                    @endif
		                          	@if($items['options']['size'] > 0)
                                    <li class="size_shoppingcart">
                                    {{$items['options']['size']}}</li>
                                    @else
                                    <li class="size_shoppingcart">There is no size Attributes selected for this product!.
                                    </li>
                                    @endif
		                          	<li id="tot_price">{{Currency::format($items['price'], Session::get('currency'))}}</li>
		                          	<li><a href="{{URL::to('/')}}/cart/delete?rowid={{$items['rowid']}}&back=view" >X</a></li> 
		                        </ul>
	                            @endforeach
                            @else
                                <p align="center">Your shopping bag is empty.</p>
	                        @endif
                        </div>
                    </div>
                </div>
                <div class="cart_bott_right">
                    <div class="cart_subtot">
                        <ul>
                            <li>Sub Total</li>
                            <li id="tot_val">{{Currency::format(Cart::total(), Session::get('currency'))}}</li>
                        </ul>
                    </div>
                    <div class="cart_currency">
                        <form action="#">
                            <p>CURRENCY</p>
                            <input type="radio" name="currency" value="USD" id="usd">USD
                            <input type="radio" name="currency" value="AED" id="aed">AED
                            <input type="radio" name="currency" value="GBP" id="gbp">GBP
                            <input type="radio" name="currency" value="EUR" id="eur">EUR
                            <a href="{{URL::to('/')}}/cart/shipping">
                                <input type="button" name="currency_sub" value="CONTINUE" class="currency_submit">
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- shopping_cart -->
        </div>
@include('partials.footer')
<script>
$(function() {  
        // Currency change in checkout
        $('#usd').on('ifChecked', function() {
            $('#tot_price').html("{{Currency::format(Cart::total(), 'USD')}}");
            $('#tot_val').html("{{Currency::format(Cart::total(), 'USD')}}");
            var currency = $("input[name='currency']:checked").val();
            $.ajax({
                type: 'POST',
                url: "{{URL::to('/')}}/cart/setcurrency",
                data: {'currency':currency},
                dataType: 'json',
                success: function(data) {

                }
            })
        })
        $('#aed').on('ifChecked', function() {
            $('#tot_price').html("{{Currency::format(Cart::total(), 'AED')}}");
            $('#tot_val').html("{{Currency::format(Cart::total(), 'AED')}}");
            var currency = $("input[name='currency']:checked").val();
            $.ajax({
                type: 'POST',
                url: "{{URL::to('/')}}/cart/setcurrency",
                data: {'currency':currency},
                dataType: 'json',
                success: function(data) {

                }
            })
        })
        $('#gbp').on('ifChecked', function() {
            $('#tot_price').html("{{Currency::format(Cart::total(), 'GBP')}}");
            $('#tot_val').html("{{Currency::format(Cart::total(), 'GBP')}}");
            var currency = $("input[name='currency']:checked").val();
            $.ajax({
                type: 'POST',
                url: "{{URL::to('/')}}/cart/setcurrency",
                data: {'currency':currency},
                dataType: 'json',
                success: function(data) {

                }
            })
        })

        $('#eur').on('ifChecked', function() {
            $('#tot_price').html("{{Currency::format(Cart::total(), 'EUR')}}");
            $('#tot_val').html("{{Currency::format(Cart::total(), 'EUR')}}");
            var currency = $("input[name='currency']:checked").val();
            $.ajax({
                type: 'POST',
                url: "{{URL::to('/')}}/cart/setcurrency",
                data: {'currency':currency},
                dataType: 'json',
                success: function(data) {

                }
            })
        })
    })

</script>