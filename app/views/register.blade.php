         
@extends('layouts.backend')
         @section('content')
<h1>Registration Form</h1><hr>
<h3>Please insert the informations bellow:</h3>
{{Form::open(array('url'=>'regstore','method'=>'post'))}}
<input type="text" name="name" placeholder="name"><br><br>
<input type="text" name="email" placeholder="email"><br><br>
     <input type="password" name="password" class="form-control" placeholder="Password"/><br><br>
<input type="submit" value="REGISTER NOW!">
{{Form::close()}}
@stop