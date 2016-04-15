@include('partials.header')
@section('content')
<div>
<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="#">Loging</a>
                    </li>
                </ul>
            </div>
            <div class="login_form">
                <div class="login">
                    <form action="">
                        <p>LOGIN</p>
                        {{Form::label('email')}}
                        {{Form::email('email',null, ['id' => 'email','required'])}}
            <!-- <p>{{$errors->first('email','<span class=error>:message</span>')}}</p> -->

                        {{Form::label('password')}}
                        {{Form::input('password', 'password', null, ['id' => 'password','required'])}}

                        <div>
                        @if(Session::has('flash_message1'))
                        <p class="warningmsg">{{Session::get('flash_message1')}}</p>
                        @endif
                        </div>

                        <div id="login_remember">
                        {{Form::checkbox('checkbox')}}
                        <a href="button"> 
                        {{Form::submit('login',['id' => 'submit'])}}
                        </a>
                        <span id="login_pw">Forgot Password?</span>
                        <span id="login_reg">New User? <a href="{{URL::to('/')}}/register"> Registor</a>
                        </span>
                    </form>
                </div>
                <div class="forgot_pw">
                    <form>
                        <label>Enter your e-mail address</label>
                        <input type="email">
                        <button id="pw_submit">SUBMIT</button>
                    </form>
                </div>
                <div class="we_sent">
                    <p>We have sent you an e-mail with your new password.</p>
                </div>
            </div>
</div>
</div>

@include('partials.footer')