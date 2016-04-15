<html>
<head>
	<title>change password</title>
</head>
<body>
{{Form::open(['route' => 'frontend.auth.changePassword'])}}	
	{{Form::label('emailaddress','Email Address')}}
    {{Form::email('email',null, ['id' => 'emailaddress','required'])}}
    {{$errors->first('email','<span class=error>:message</span>')}}

    {{Form::label('password')}}
    {{Form::input('password', 'password', null, ['id' => 'password','required'])}}
    {{$errors->first('password','<span class=error>:message</span>')}}

    {{Form::label('confirmpassword','Confirm Password')}}
    {{Form::input('password', 'confirmpassword', null, ['id' => 'confirmpassword','required'])}}
    {{$errors->first('confirmpassword','<span class=error>:message</span>')}}
    {{Form::hidden('code', $code)}}
    {{Form::submit('Reset',['id' => 'submit'])}}
{{Form::close()}}
</body>
</html>