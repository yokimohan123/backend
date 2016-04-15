@include('partials.header')
@section('content')


<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="#">Register</a>
                    </li>
                </ul>
            </div>

            <div>
                @if(Session::has('flash_message'))
                <p style="font-family:'Roboto'sans-serif;color: green;">{{Session::get('flash_message')}}</p>
                @endif
            </div>

            <div class="contact_details">
             {{Form::open(['route' => 'frontend.auth.register'])}}
                <p>CONTACT DETAILS</p>
                {{Form::label('firstname','First Name')}}
                {{Form::input('text', 'firstname', null, ['id' => 'firstname'])}}
                {{$errors->first('firstname','<span class=error>:message</span>')}}


                {{Form::label('lastname')}}
                {{Form::input('text', 'lastname', null, ['id' => 'lastname'])}}
                {{$errors->first('lastname','<span class=error>:message</span>')}}

               
                <label for="dateofbirth" style="">Date of Birth</label>
                <input type="date" name="bday" max="1979-12-31">
                <label for="gender" style="">Gender</label>
                <div class="radio_con">
                    <div class="radio">
                        <input type="radio" name="gender" value="male" checked> <span>Male</span>
                    </div>
                    <div class="radio">
                        <input type="radio" name="gender" value="female"> <span> Female </span>
                    </div>
                </div>

                {{Form::label('billing_address','Billing Address')}}
                {{Form::input('text', 'billing_address', null, ['id' => 'billing'])}}
                {{$errors->first('billing_address','<span class=error>:message</span>')}}

                {{Form::label('billing_city','City/Town')}}
                {{Form::input('text', 'billing_city', null, ['id' => 'city'])}}
                {{$errors->first('billing_city','<span class=error>:message</span>')}}

                {{Form::label('zip_code','Zip Coder')}}
                {{Form::input('text', 'zip_code', null, ['id' => 'zip_code'])}}
                {{$errors->first('zip_code','<span class=error>:message</span>')}}
               
                {{Form::label('phone_number','Phone Number')}}
                {{Form::input('text', 'phone_number', null, ['id' => 'phone_number'])}}
                {{$errors->first('phone_number','<span class=error>:message</span>')}}

                {{Form::label('country','Country')}}
                {{Form::input('text', 'country', null, ['id' => 'country'])}}
                {{$errors->first('country','<span class=error>:message</span>')}}              
               
            </div>
            <div class="login_information">
                <p>LOGIN INFORMATION</p>

                {{Form::label('emailaddress','Your Email Address')}}
                {{Form::email('email',null, ['id' => 'emailaddress'])}}
                {{$errors->first('email','<span class=error>:message</span>')}}
                
                {{Form::label('password')}}
                {{Form::input('password', 'password', null, ['id' => 'password'])}}
                {{$errors->first('password','<span class=error>:message</span>')}}

                {{Form::label('password_confirmation','Confirm Password')}}
                {{Form::input('password', 'password_confirmation', null, ['id' => 'password_confirmation'])}}
                {{$errors->first('password_confirmation','<span class=error>:message</span>')}}

                <div id="login_remember">
                    <input type="checkbox" name="remember" value="rememberme"><span>I agree to the <a href="#">Terms & Conditions</a></span>
                </div>
                {{$errors->first('registerCheckbox','<span class=error>:message</span>')}}
                {{Form::submit('Register',['id' => 'submit'])}}
            </div>
             {{Form::close()}}
        </div>

@include('partials.footer')