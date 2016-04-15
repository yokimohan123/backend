@extends('layouts.backend')
@section('content')
<a href="<?php echo URL::to('/'); ?>/backend/maincategory" class="btn bg-olive btn-flat margin" style="float:right;">Go Back</a>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit About Category</h3>
            </div><!-- /.box-header -->

            @if ($errors->has())        
            @foreach ($errors->all() as $error)
            <ul style="color:red;">
                {{ $error }}
            </ul>
            @endforeach     
            @endif
            
            <!-- form start -->
            {{ Form::model($block, ['route' => 'backend.maincategory.update_category',$block['id']],'method' => 'post') }}                              
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            {{ Form::label('exampleInputTitle', 'Category:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Category is required")) }}
                            {{ Form::text('name',{{$block['name']}}, array('class' => 'form-control','placeholder' => 'Enter Name','id' => 'exampleInputTitle1')) }} 

                            {{ Form::label('exampleInputTitle', 'Description:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Description is required")) }}
                            {{ Form::text('description',{{$block['description']}}, array('class' => 'form-control','placeholder' => 'Enter Description','id' => 'exampleInputTitle1')) }}

                            {{ Form::label('exampleInputTitle', 'Slug:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Slug is required")) }}
                            {{ Form::text('slug',{{$block['slug']}}, array('class' => 'form-control','placeholder' => 'Enter Slug','id' => 'exampleInputTitle1')) }} 
                        </div>
                    </fieldset>                                        
                </div>
                <div class="modal-footer clearfix">                    
                    <button type="submit" class="btn btn-primary pull-left">Submit</button>
                </div>                
            {{ Form::close() }}            
        </div><!-- /.box -->
    </div>
</div>
@stop
