<html>
<head>
    <title>forget password</title>
    <link rel="stylesheet" href="css/reset-normalize.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="skins/minimal/grey.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div>
        @if(Session::has('flash_message'))
            <p>{{Session::get('flash_message')}}</p>
        @endif
    </div>
    
    <div class="content-container1">
        <div class="reg-customer">
            {{Form::open(['route' => 'frontend.auth.reset'])}}
                <div class="Register">
                    <h5>Forget Password</h5>

                    {{Form::label('email')}}
                    {{Form::email('email',null, ['id' => 'email','required'])}}
                    <p>{{$errors->first('email','<span class=error>:message</span>')}}</p>
                </div>
                <div >                
                    {{Form::submit('reset',['id' => 'submit'])}}
                </div>
            {{Form::close()}}
        </div>

        
 </div>    
</body>
</html>
 