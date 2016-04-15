@include('partials.header')
@section('content')
        <!--nav-container-->
        <div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}/">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/terms-and-condition">Terms and condition</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12" id="private-policy">
                <p class="terms-of-service">TERMS OF SERVICE</p>
                {{$terms->content}}
            </div>
        </div>

@include('partials.footer')