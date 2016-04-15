@include('partials.header')
@section('content')
        <!--nav-container-->
        <div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}/">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/private-policy">Private Policy</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12" id="private-policy">
                <p class="policy">PRIVACY POLICY DIMA AYAD</p>
                {{$policy->content}}
            </div>
        </div>

@include('partials.footer')