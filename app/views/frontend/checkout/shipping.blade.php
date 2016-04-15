@include('partials.header')
@section('content')
		<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="cart/shipping">Cart</a>
                    </li>
                </ul>
            </div>

            <!-- SHIPPING -->

            <div class="shipping">
                <div class="cart_navbar">
                    <ul>
                        <li><a href="">Back to Shopping</a></li>
                        <li class="cart_active" id="nav_cart">
                        <h1 class="text-shop">1</h1>
                        <p class="text-background">Shopping Cart</p></li>
                        <li class="cart_active" id="nav_shipping">
                        <h1 class="text-shop">2</h1>
                        <p class="text-background">Shipping</p></li>
                        <li id="nav_payment">3. Payment</li>
                        <li id="nav_confirm">4. Confirmation</li>
                    </ul>
                </div>
                <div class="shipping_table">
                    <div class="shipping_items">
                        <div class="ship_itm_head">
                            <ul>
                                <li id="Items">ITEMS</li>
                                <li id="delivery_options">DELIVERY OPTIONS</li>
                            </ul>
                        </div>
                        @if(count($cart_items)>0)
                            @foreach($cart_items as $items)
                                <div class="ship_itm_content">
                                    <div class="itm_cntnt_algn">
                                        <div class="ship_itm_left">
                                            <ul>
                                                <li>{{$items['name']}}
                                                    <span id="light_clr">#{{$items['id']}}</span>
                                                </li>
                                                <li id="light_clr">QTY: {{$items['qty']}}</li>
                                                <li>{{Currency::format($items['subtotal'], "Session::get('currency')")}}</li>
                                            </ul>
                                        </div>

                                        <div class="ship_itm_right">
                                            <input type="radio" name="delivery_one" value="Standard" checked id="std-delivery">
                                            <label for="std-delivery">Standard delivery (3-5 Days)</label>
                                            <input type="radio" name="delivery_one" value="Express" id="exp-delivery">
                                            <label for="exp-delivery">Express delivery (1-2 Days)</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="shipping_address">
                        <div class="change_address">
                            <p id="ship_adrs">SHIPPING ADDRESS</p>
                            <form id="shipping_address">
                                <div id="shp_adr">
                                    <div id="shp_adr_radio">
                                        <!-- <input type="radio" name="address" value="profile" id="profile">Profile’s Shipping Address
                                        <input type="radio" name="address" value="change_address" id="change_adrs">Change Shipping Address -->
                                        <input type="hidden" name="address" value="change_address" id="change_adrs">
                                    </div>
                                    <span id="select_shipping">Select shipping address</span>
                                    <span id="invalid">Please fill all fields</span>
                                    @if (!Auth::check())
                                        <label for="change_adr">Name*</label>
                                        {{Form::text('name', null, array('id' => 'name'))}}
                                        <label for="change_adr">Email*</label>
                                        {{Form::text('email', null, array('id' => 'email'))}}
                                        <span id="email_exist">Email exist, please Enter correct Email to continue</span>
                                    @endif
                                    <label for="change_adr">Adddress*</label>
                                    {{Form::text('shipping_adr', null, array('id' => 'change_adr'))}}
                                     <div id="shipping_adr" style="display:none;color:#a94442 ; font-size:12px;">please select shipping address</div>  
                                    <label for="change_town">City/Town*</label>
                                    {{Form::text('shipping_town', null, array('id' => 'change_town'))}}
                                     <div id="shipping_town" style="display:none;color:#a94442 ; font-size:12px;">please select shipping town</div>
                                    <label for="change_zip">ZIP Code*</label>
                                    {{Form::text('shipping_zip', null, array('id' => 'change_zip'))}}
                                    <div id="shipping_zipcode" style="display:none;color:#a94442 ; font-size:12px;">please select shipping zipcode</div>
                                    <label for="change_country">Country*</label>
                                    {{Form::text('shipping_country', null, array('id' => 'change_country'))}}
                                    <div id="shipping_country" style="display:none;color:#a94442 ; font-size:12px;">please select shipping country</div>
                                    <label>Phone: 
                                        <span id="light_clr">675 456 78
                                        <!-- <span><a> (Change) </a> -->
                                        </span>
                                    </label>
                                </div>
                                <div class="profile_address">
                                    <input type="radio" name="address" value="profile" id="profile" >Profile’s Shipping Address
                                    <br />
                                    <span id="plz_login">Login to continue</span>
                                    @if (!Auth::check())
                                        <li>Address not found</li>
                                    @elseif(count($address)>0)
                                        <li>{{$address->shipping_address}}</li>
                                        <li>{{$address->shipping_city}}</li>
                                        <li>{{$address->shipping_zipcode}}</li>
                                        <li style="margin-bottom: 20px;">{{$address->shipping_country}}
                                            <!-- <span>(Change)</span> -->
                                        </li>
                                    @else
                                        <li>Address not found</li>
                                    @endif
                                    <input type="radio" name="address" value="change_address" id="change_adrs">Change Shipping Address
                                    <p>
                                        <span id="clr_bld">Phone:</span>675 456 78
                                        <!-- <span><a> (Change) </a> -->
                                        <!-- </span> -->
                                    </p>
                                </div>
                                <input type="button" value="CONTINUE" class="shipping_submit" id="shipping_submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- shipping -->
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
