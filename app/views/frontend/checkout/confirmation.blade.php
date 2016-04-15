@include('partials.header')
@section('content')
		<div class="content-container"> 
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/cart/confirm">Cart</a>
                    </li>
                </ul>
            </div>

            <div class="confirmation">
                <div class="cart_navbar">
                    <ul>
                        <li><a href="">Back to Shopping</a>
                        </li>
                        <li class="cart_active" id="nav_cart">
                        <h1 class="text-shop">1</h1> 
                        <p class="text-background">Shopping Cart</p></li>
                        <li class="cart_active" id="nav_shipping">
                        <h1 class="text-shop">2</h1>
                        <p class="text-background">Shipping</p></li>
                        <li class="cart_active" id="nav_payment">
                        <h1 class="text-shop">3</h1>
                        <p class="text-background">Payment</p></li>
                        <li class="cart_active" id="nav_confirm">
                        <h1 class="text-shop">4</h1>
                        <p class="text-background">Confirmation</p></li>
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
                            <li>Date</li>
                            <li>Discription</li>
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
                                        <span id="clr_gry"> #{{$items['id']}}</span>
                                    </li>
                                    <li>{{$items['qty']}}</li>
                                    <li>{{date("m-d-Y")}}</li>
                                    <li>Size : {{$items['options']['size']}}
                                        </li>
                                    <li>{{Currency::format($items['price'], Session::get('currency'))}}</li>
                                    <li><a href="{{URL::to('/')}}/cart/delete?rowid={{$items['rowid']}}&back=confirm" >X</a></li> 
                                </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="confirm_bottom">
                    <div class="confirm_address">
                        <p>SHIPPING ADDRESS</p>
                        <ul>
                            @if(count($address)>0)
                                <li>{{$address->shipping_address}}</li>
                                <li>{{$address->shipping_city}}</li>
                                <li>{{$address->shipping_zipcode}}</li>
                                <li>{{$address->shipping_country}}</li>
                                @if (!Auth::check())
                                    <li>{{$user->phone_no}}</li>
                                @else
                                    <li>{{Auth::user()->phone_no}}</li>
                                @endif
                            @else
                                <li>Address Not Found</li>
                            @endif
                        </ul>
                    </div>
                    <div class="confirm_payment">
                        <P>PAYMENT DETAILS</P>
                        @if($payment_detail['payment'] =="paypal")
                            <ul>
                                <li>Transaction Type</li>
                                <li>Paypal</li>
                                <li>Paypal Email</li>
                                <li>{{$payment_detail['paypal_email']}}</li>
                            </ul>
                        @elseif($payment_detail['payment'] =="credit_cadrd")
                            <ul>
                                <li>Card Type</li>
                                <li>Visa</li>
                                <li>Card Number</li>
                                <li>**** **** **** {{$payment_detail['cr_no4']}}</li>
                                <li>Card Name</li>
                                <li>{{$payment_detail['cr_name']}}</li>
                                <li>Expiration Date</li>
                                <li>{{$payment_detail['expir_month']}} / {{$payment_detail['expir_year']}}</li>
                            </ul>
                        @elseif($payment_detail['payment'] =="cash_delivery")
                            <ul>
                                <li>Payment Type</li>
                                <li>Cash on delivery</li>
                            </ul>
                        @endif
                    </div>
                    <div class="confirm_total">
                        <P>ORDER TOTAL</P>
                        <ul id="confirm_item">
                            @if(count($cart_items)>0)
                                @foreach($cart_items as $items)
                                    <li>{{$items['name']}}</li>
                                    <li>{{Currency::format($items['price'], Session::get('currency'))}}</li>
                                @endforeach
                            @endif
                        </ul>
                        <ul id="confirm_tot">                        
                            <li>Sub-total</li>
                            <li>{{Currency::format(Cart::total(), Session::get('currency'))}}</li>
                            <li>Shipping</li>
                            <li>{{Currency::format(0, Session::get('currency'))}}</li>
                            <li id="alg_bold">Total</li>
                            <li id="alg_bold">{{Currency::format(Cart::total(), Session::get('currency'))}}</li>
                        </ul>
                        <form action="payment" method="POST">
                            <input type="submit" value="CONTINUE" class="confirm_submit">
                        </form>
                    </div>
                </div>
            </div>
            <!-- confirmation -->
        </div>
@include('partials.footer')