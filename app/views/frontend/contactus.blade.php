@include('partials.header')
@section('content')



        <!--nav-container-->

<div class="content-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{URL::to('/')}}/">Home</a>
                        <span class="gt">&rsaquo;</span>
                    </li>
                    <li><a href="{{URL::to('/')}}/contactus">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="contact_form">
                <p>CONTACT DIMA AYAD</p>
                    @if ($errors->any())
                    <ul style="color:red;">
                        {{ implode('', $errors->all('<li>:message</li>')) }}
                    </ul>
                    @endif
                    @if (Session::has('message'))
                    <p style="color: green;">{{ Session::get('message') }}</p>
                    @endif

                <form action="{{URL::route('frontend.contactus')}}" method="post" enctype="multipart/form-data">
                    <label>Name*</label>
                    <!-- <input type="text"> -->
                    <div class="name_cntctfrm">
                        <div class="fist_nm">
                            
                         
                            {{ Form:: text ('first_name', '',array('id'=>'firstNm') )}}
                             <span id="firstNm">First Name</span>
                        </div>
                        <div class="secnd_nm">
                           
                           
                            {{ Form:: text ('last_name', '',array('id'=>'secondNm') )}}
                            <span id="secondNm">Last Name</span>
                        </div>
                    </div>
                    <label>E-mail address*</label>
                    {{ Form:: email ('email', '') }}   
                    <label for="Phone Number">Phone Number *</label>
                    {{ Form:: text ('phone_number', '') }}
                    <label>Subject*</label>
                    {{ Form:: text ('subject', '' )}}
                    <label>Message*</label>
                    {{ Form:: textarea ('message', '' )}}
                    {{Form::submit('SEND', ['class' => 'cnt-frm'])}}
                </form>
            </div>
        </div>

@include('partials.footer')