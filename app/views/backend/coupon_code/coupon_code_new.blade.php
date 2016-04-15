@extends('layouts.backend')
@section('content')
<div class="row">
   <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
                    <li class="{{ $first_tab }}"><a href="#tab_information" data-toggle="tab">@if(isset($coupon_code->id)) {{ "Edit" }} @else {{ "Add" }} @endif  Coupon Code</a></li>
                    @if(isset($coupon_code->id))
                        <li class="{{$second_tab}}"><a href="#tab_condition" data-toggle="tab">Conditions</a></li>                    
                    @endif
                    <li class="pull-right"><a href="{{URL::route('backend.coupon-code')}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>

        </ul>
                    @if(Session::has('information_msg'))
                        <div class="alert alert-success">
                            {{ Session::get('information_msg') }}
                        </div>
                    @endif
                    
                    @if ($errors->all() != null)
                    <ul class="error">
                        @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                        @endforeach
                    </ul>
                    @endif
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->      
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add New Coupon Code</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="tab-content">
                <div class="tab-pane {{$first_tab}}" id="tab_information">
                    @if(isset($coupon_code->id))
                                {{ Form::model($coupon_code, ['route' => ['backend.coupon-code.update', $coupon_code->id], 'method' => 'post', 'enctype' =>    'multipart/form-data']) }}
                    @else
                                {{ Form::model($coupon_code, ['route' => ['backend.coupon-code.new'],  'method' => 'post']) }}
                    @endif           
                                                                

                                    <fieldset>
                                        <div class="form-group">
                                            {{ Form::label('name', 'Name:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Name is required")) }}
                                            {{ Form::text('name',null, array('class' => 'form-control','placeholder' => 'Enter Name','id' => 'exampleInputTitle1')) }}

                                            {{ Form::label('description', 'Description:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Description is required")) }}
                                            {{ Form::textarea('description',null, array('class' => 'form-control','placeholder' => 'Enter Description','id' => 'exampleInputTitle1')) }}


                                            {{ Form::label('code', 'Code:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Code is required")) }}
                                            {{ Form::text('code',null, array('class' => 'form-control','placeholder' => 'Enter Code ','id' => 'exampleInputTitle1')) }}  


                                        </div>
                                    </fieldset>
                            
                            <div class="modal-footer clearfix">
                                
                                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-camera"></i> Sumbit</button>
                            </div>
                {{ Form::close() }}
                </div>
            @if(isset($coupon_code->id))
                    <div class="tab-pane{{$second_tab}}" id="tab_condition">
                    {{ Form::model($coupon_code, ['route' => ['backend.coupon-code.save_user_list', $coupon_code->id], 'method' => 'post', 'id'=>'tab_condition']) }}                       
                        @foreach($users as $user_list)
                            <div class="form-group">
                            <input  name="email" type="checkbox" value="{{$user_list['email']}}">
                            {{ Form::label('email',$user_list['email']) }}
                            </div>
                        @endforeach          

                        {{ Form::button('Update',array('class'=>'btn btn-success','type' => 'submit')) }}
                    </div>
            @endif
        </div><!-- /.box -->
        </div>
    </div>
</div>
</div>
@stop
@if(isset($coupon_code->id))
@section('javascript')

Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("");
myDropzone.on("queuecomplete", function(file) {
  setTimeout(
  function() 
  {
    //do something special
    location.href='{{URL::route("backend.coupon-code.edit",$coupon_code->id)}}'
  }, 2000);
  
});
@endif
@stop
