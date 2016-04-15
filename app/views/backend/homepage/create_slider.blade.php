@extends('layouts.backend')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements --> 
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@if(isset($homepageslider->id)) Edit @else Add New @endif Slider Image</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Go Back">
                    <li class="pull-right"><a href="{{URL::route('homesliders')}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>
                </div>
            </div><!-- /.box-header -->
            @if(Session::has('image_size'))
                <div class="alert alert-danger">
                    {{ Session::get('image_size') }}
                </div>
            @endif
            @if ($errors->has())        
                @foreach ($errors->all() as $error)
                    <ul style="color:red;">
                        {{ $error }}
                    </ul>
                @endforeach     
            @endif
            <div class="box-body">
             @if(isset($homepageslider->id))
                {{ Form::model($homepageslider, ['route' => ['backend.home_slider.update', $homepageslider->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            @else
                {{ Form::model($homepageslider, ['route' => ['backend.home_slider.store'],  'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            @endif
            <div class="form-group ">
                <label for="file">Upload Slider:</label>
                
                <input type="file" name="image" id="file">@if(isset($homepageslider->id)) <?php echo "<a href='".URL::to('/uploads/home/slider')."/".$homepageslider->image."' target='_blank'>Image</a>"; ?> @endif
                <p>Max 2MB and resolution of 1365*745.</p>                   
                <span class="errorRed"></span>
            </div>
            <div class="form-group">
                {{ Form::label('title', 'Title:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Title is required")) }}
                {{ Form::text('title',null, array('class' => 'form-control','placeholder' => 'Enter Title')) }}
            </div>
            <div class="form-group">    
                {{ Form::label('alt', 'Alt Tag:',array('data-toggle'=>"tooltip", 'data-original-alt'=>"Alt Tag is required")) }}
                {{ Form::text('alt',null, array('class' => 'form-control','placeholder' => 'Enter Alt Tag')) }}
            </div>
            <div class="form-group">
                {{ Form::label('month', 'Month:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Month is required")) }}
                {{ Form::input('date','month',null, ['class' => 'form-control','placeholder' => 'Enter Month']) }}
            </div>
            <div class="form-group">    
                {{ Form::label('link', 'Link:',array('data-toggle'=>"tooltip", 'data-original-link'=>"Link is required")) }}
                {{ Form::text('link',null, array('class' => 'form-control','placeholder' => 'Enter Link')) }}
                                
            </div>
            <div class="form-group"> 
            {{ Form::label('color', 'Color:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Color is required")) }}
            {{ Form::input('color','color',null, array('class' => 'form-control-color','placeholder' => 'Enter Color','id' => 'exampleInputTitle1')) }}
            </div>    
                                                    
            <div class="box-footer">
                {{ Form::button('Submit',array('class'=>'btn btn-primary pull-left','value' => '0', 'name' => 'upload_now', 'type' => 'Upload Now')) }}
            </div>
            {{ Form::close() }}
        </div>
                
            
            <!-- form start -->
            
        </div><!-- /.box -->
    </div>
</div>
@stop