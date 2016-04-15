@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Go Back">
                    <li class="pull-right"><a href="{{URL::route('backend.users.index')}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>
                </div>
            </div>
            @if(isset($user->id))
            {{ Form::model($user, ['route' => ['backend.users.update', $user->id], 'method' => 'post']) }}
            @else
            {{ Form::model($user, ['route' => ['backend.users.create'], 'method' => 'post']) }}
            @endif         
            <div class="box-body">
                @if ($errors->all() != null)
                <ul class="error">
                    @foreach($errors->all() as $err)
                    <li>{{$err}}</li>
                    @endforeach
                </ul>
                @endif  
                 @if (Session::has('message'))
                   <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif             
                <div class="form-group">
                    {{ Form::label('first_name', 'First Name*',array('data-toggle'=>"tooltip", 'data-original-title'=>"First name is required")) }}
                    {{ Form::text('first_name',null, array('class' => 'form-control','placeholder' => 'First Name')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name',array('data-toggle'=>"tooltip", 'data-original-title'=>"Last name is required")) }}
                    {{ Form::text('last_name',null, array('class' => 'form-control','placeholder' => 'Last Name')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email',array('data-toggle'=>"tooltip", 'data-original-title'=>"Email is required")) }}
                    {{ Form::text('email',null, array('class' => 'form-control','placeholder' => 'Enter Email')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('username', 'Username',array('data-toggle'=>"tooltip", 'data-original-title'=>"Username is required")) }}
                    {{ Form::text('username',null, array('class' => 'form-control','placeholder' => 'Enter Username')) }}
                </div>
                <div class="form-group1">
                    {{ Form::label('password', 'Password:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Password is required"))}}
                    {{ Form::password('password',null, array('class' => 'form-control','placeholder' => 'Enter Password','style'=>'margin-left:21px')) }}
                </div>
                <div class="form-group">
                    <a href ="{{URL::to('/')}}/backend/users/change">Edit Password</a>                                       
                </div>
                <div class="box-footer">
                    {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
                    {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop