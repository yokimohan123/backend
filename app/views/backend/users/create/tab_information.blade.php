<h3 class="box-title">Edit a User</h3>
@if(isset($users->id))
{{ Form::model($user, ['route' => ['backend.users.update', $user->id], 'method' => 'patch']) }}
@else
{{ Form::open(['route' => 'backend.users.create']) }}
@endif


<div class="box-body">
    <div class="form-group">
        {{ Form::label('id', 'Id') }}
        {{ Form::text('id',null, array('class' => 'form-control','placeholder' => 'Enter Id')) }}
    </div>
    <div class="form-group">
        {{ Form::label('first_name', 'First name') }}
        {{ Form::text('firstname',null, array('class' => 'form-control','placeholder' => 'Enter First Name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('last_name', 'Lastname') }}
        {{ Form::text('lastname',null, array('class' => 'form-control','placeholder' => 'Enter Lastname')) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email',null, array('class' => 'form-control','placeholder' => 'Enter Email')) }}
    </div>
    <div class="form-group">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username',null, array('class' => 'form-control','placeholder' => 'Enter Username')) }}
    </div>     
    <div class="form-group">
         <a href ="{{URL::to('/')}}/backend/password/password_change">Edit Password</a>                                       
    </div>
    <div class="box-footer">
        {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
        {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
    </div>
</div>
{{ Form::close() }}