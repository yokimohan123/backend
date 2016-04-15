@include('partials.header')
@section('content')
    <div class="content-container">
        <div class="check_out">
            <p>Thank you for shopping Dima Ayad Collection!
                <br/>Your order has been placed and will be dispatched soon.
            </p>
            <p>You will soon receive a confirmation e-mail about your order.</p>
            <ul>
                <!-- <li><a href="">MY ORDERS ></a></li> -->
                <li><a href="{{URL::to('/')}}/contactus">CONTACT US ></a>
                </li>
            </ul>
        </div>
    </div>
@include('partials.footer')