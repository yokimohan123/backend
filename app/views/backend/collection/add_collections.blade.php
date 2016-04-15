@extends('layouts.backend')
@section('content')
<div class="row">
   <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
                    <li class="{{ $first_tab }}"><a href="#tab_information" data-toggle="tab">@if(isset($collection->id)) {{ "Edit" }} @else {{ "Add" }} @endif  Collections</a></li>
                    @if(isset($collection->id))
                        <li class="{{$second_tab}}"><a href="#tab_images" data-toggle="tab">Images</a></li>                    
                    @endif
                    <li class="pull-right"><a href="{{URL::route('backend.collection')}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>

        </ul>
                    @if(Session::has('collect_msg'))
                        <div class="alert alert-success">
                            {{ Session::get('collect_msg') }}
                        </div>
                    @endif
                    @if(Session::has('image_size'))
                        <div class="alert alert-danger">
                            {{ Session::get('image_size') }}
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
                <h3 class="box-title">Add New Images</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="tab-content">
                <div class="tab-pane {{$first_tab}}" id="tab_information">
                    @if(isset($collection->id))
                                {{ Form::model($collection, ['route' => ['backend.collection.update', $collection->id], 'method' => 'post', 'enctype' =>    'multipart/form-data']) }}
                    @else
                                {{ Form::model($collection, ['route' => ['backend.collection.store'],  'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                    @endif           
                            
                                    <div class="form-group ">
                                        <label for="file">Upload Slider:</label>
                                        <input type="file" name="image" id="file"> 
                                        @if(isset($collection->id))
                                            <p>Upload to replace the below image.</p>
                                            <p><b>Note:</b> Image dimension must be 1300x560 </p>                  
                                            <span class="errorRed"></span>
                                            <img src="<?php echo URL::to('/') . '/uploads/collections/cover/'.$collection->id.'/' . $collection->image; ?>" alt="" />
                                        @endif
                                        <span class="errorRed"></span>
                                    </div>

                                    <fieldset>
                                        <div class="form-group">
                                            {{ Form::label('title', 'Title:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Title is required")) }}
                                            {{ Form::text('title',null, array('class' => 'form-control','placeholder' => 'Enter Title','id' => 'exampleInputTitle1')) }}

                                            {{ Form::label('alt', 'Alt Tag:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Alt Tag is required")) }}
                                            {{ Form::text('alt',null, array('class' => 'form-control','placeholder' => 'Enter Alt Tag','id' => 'exampleInputTitle1')) }} 

                                            {{ Form::label('color', 'Color:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Color is required")) }}
                                            {{ Form::input('color','color',null, array('class' => 'form-control-color','placeholder' => 'Enter Color','id' => 'exampleInputTitle1')) }}                           
                                        </div>
                                    </fieldset>
                            
                            <div class="modal-footer clearfix">
                                <a href="<?php echo URL::to('/'); ?>/backend/collection/create" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</a>
                                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-camera"></i> Upload Now</button>
                            </div>
                {{ Form::close() }}
                </div>
            @if(isset($collection->id))
                    <div class="tab-pane {{$second_tab}}" id="tab_images">
                        <p><b>Note:</b> Image dimension must be 1300x560 </p>      
                        {{ Form::model($collection, ['route' => ['backend.collection.images', $collection->id], 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id'=>'collection_images']) }}                       
                        {{ Form::close() }}
                        <div>
                            @foreach ($collection_images as $image)
                            <div style="float: left;margin-left: 10px;width:252px;padding:5px;border:1px solid #ccc;border-radius:5px;">
                                <img src="{{URL::to('/')}}/uploads/collections/thumb/{{$collection->id}}/{{$image['image']}}"  />
                                {{ Form::model($collection, ['route' => ['backend.collection.image_delete',$image['id']], 'method' => 'post']) }}
                                <br />
                                <div class="box-body">                                    
                                    <div class="box-footer">                                       
                                         <div class="form-group">
                                                {{ Form::label('meta_title', 'Meta Title*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Meta Title is required")) }}
                                                {{ Form::text('meta_title',$image['meta_title'], array('class' => 'form-control','placeholder' => 'Enter Meta Title')) }}
                                         </div>
                                        <div class="form-group">
                                                {{ Form::label('link', 'Link*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Link is required")) }}
                                                {{ Form::text('link',$image['link'], array('class' => 'form-control','placeholder' => 'Enter Link')) }}
                                        </div>                                                                                                     
                                        {{ Form::button('Update',array('class'=>'btn btn-success','type' => 'submit')) }}
                                        {{ Form::button('Delete',array('class'=>'btn btn-danger','name'=>'delete','value'=>'1','type' => 'submit')) }}                                        
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                            @endforeach
                            <div class="clearfix"></div>
                        </div>                    
                    </div>
            @endif
        </div><!-- /.box -->
        </div>
    </div>
</div>
</div>
@stop
@if(isset($collection->id))
@section('javascript')

Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#collection_images");
myDropzone.on("queuecomplete", function(file) {
  setTimeout(
  function() 
  {
    //do something special
    location.href='{{URL::route("backend.collection.edit",$collection->id)}}'
  }, 2000);
  
});
@endif
@stop
