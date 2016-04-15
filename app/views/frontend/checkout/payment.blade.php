@include('partials.header')
@section('content')
		<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/cart/payment">Payment</a>
                    </li>
                </ul>
            </div>

            <!-- Payment -->
            <div class="payment">
                <div class="cart_navbar">
                    <ul>
                        <li><a href="">Back to Shopping</a>
                        </li>
                        <li class="cart_active"id="nav_cart">
                        <h1 class="text-shop">1</h1>
                        <p class="text-background">Shopping Cart</p></li>
                        <li class="cart_active" id="nav_shipping">
                        <h1 class="text-shop">2</h1>
                        <p class="text-background">Shipping</p></li>
                        <li class="cart_active" id="nav_payment">
                        <h1 class="text-shop">3</h1>
                        <p class="text-background">Payment</p></li>
                        <li id="nav_confirm">4. Confirmation</li>
                    </ul>
                </div>
                <div class="payment_content">
                    <div class="payment_address">
                        <p id="pay_biladr">BILLING ADDRESS</p>
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
                    <form action="paymentdetail" method="POST">
                        <div class="payment_option">
                            <p>PAYMENT OPTIONS</p>
                            <div class="payment_radio">
                                <input type="radio" name="payment" value="paypal" checked id="paypal">PayPal</div>
                            <div class="payment_radio">
                                <input type="radio" name="payment" value="credit_cadrd" id="creditcard">Credit Card</div>
                            <!-- <div class="payment_radio"> -->
                                <!-- <input type="radio" name="payment" value="cash_delivery" id="cash">Cash On Delivery</div> -->
                        </div>
                        <div class="payment_card">
                            <div class="payment_credit">
                                <div class="card_info">
                                    <p>CREDIT CARD INFORMATION</p>
                                    <ul>
                                        <li>
                                            <img src="{{URL::to('/')}}/images/visa.png">
                                        </li>
                                        <li>
                                            <img src="{{URL::to('/')}}/images/master_card.png">
                                        </li>
                                        <li>
                                            <img src="{{URL::to('/')}}/images/mastro.png">
                                        </li>
                                        <li>
                                            <img src="{{URL::to('/')}}/images/solo.png">
                                        </li>
                                        <li>
                                            <img src="{{URL::to('/')}}/images/american.png">
                                        </li>
                                        <li>
                                            <img src="{{URL::to('/')}}/images/discover.png">
                                        </li>

                                    </ul>
                                </div>
                                <div class="card_no">
                                    <p>Credit Card Number*</p>
                                    <input type="text" name="cr_no1" id="first" onkeyup="movetoNext(this, 'second')" maxlength="4">
                                    <input type="text" name="cr_no2" id="second" onkeyup="movetoNext(this, 'third')" maxlength="4">
                                    <input type="text" name="cr_no3" id="third" onkeyup="movetoNext(this, 'fourth')" maxlength="4">
                                    <input type="text" name="cr_no4" id="fourth" maxlength="4">
                                </div>
                                <div class="expir_date">
                                    <p>Expiration Date*</p>
                                    <select name="expir_month">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <?php $years = range ( date( 'Y' ), date( 'Y') + 10 );?>
                                    <select name="expir_year">
                                    @foreach ( $years as $year )                                       
                                        <option value="{{$year}}">{{$year}}</option> 
                                    @endforeach
                                    </select>
                                </div>
                                <div class="card_name">
                                    <p>Name on Card*</p>
                                    <input type="text" name="cr_name">
                                </div>
                                <div class="csc">
                                    <p>CSC*</p>
                                    <input type="text" name="csc">
                                    <img id="info_img" src="{{URL::to('/')}}/images/csc_info.jpg">
                                    <span id="img_info">CSC is a three- or four-digit value printed on the back of the card or on the signature strip on the back
                                    </span>
                                </div>
                            </div>
                            <div class="payment_paypal">
                                <img src="{{URL::to('/')}}/images/paypal.png">

                                <label for="pay_email">E-mail</label>
                                <input type="email" name="paypal_email" id="pay_email">
                            </div>
                            <input type="submit" name="currency_sub"value="CONTINUE" class="payment_submit"id="payment_btn">
                    </div>
                </form>

                </div>

            </div>
            <!-- payment -->
        </div>
@include('partials.footer')
<script>
    function movetoNext(current, nextFieldID) {
        if (current.value.length >= current.maxLength) {
            document.getElementById(nextFieldID).focus();
        }
    }
</script>