@extends('layouts.backend')
@section('content')
<a href="<?php echo URL::to('/'); ?>/backend/categories" class="btn bg-olive btn-flat margin" style="float:right;">Go Back</a>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add New Category</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            {{ Form::open(['route' => 'backend.maincategory.add']) }}            
                <div class="modal-body">                    
                    <fieldset>
                        <div class="form-group">
                            {{ Form::label('exampleInputTitle', 'Category Name*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Name is required")) }}
                            {{ Form::text('name',null, array('class' => 'form-control','placeholder' => 'Enter Name','id' => 'exampleInputTitle1')) }} 

                            {{ Form::label('exampleInputTitle', 'Category Description*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Description is required")) }}
                            {{ Form::textarea('description',null, array('class' => 'form-control','placeholder' => 'Enter Description','id' => 'exampleInputTitle1')) }} 

                            {{ Form::label('exampleInputTitle', 'Category Slug:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Slug is required")) }}
                            {{ Form::text('slug',null, array('class' => 'form-control','placeholder' => 'Enter Slug','id' => 'exampleInputTitle1')) }}  

                            {{ Form::label('exampleInputTitle', 'Meta Title:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Meta Title is required")) }}
                            {{ Form::text('meta_title',null, array('class' => 'form-control','placeholder' => 'Enter Meta Title','id' => 'exampleInputTitle1')) }}                            
                            
                            {{ Form::label('exampleInputTitle', 'Meta Description:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Meta Description is required")) }}
                            {{ Form::text('meta_description',null, array('class' => 'form-control','placeholder' => 'Enter Meta Description','id' => 'exampleInputTitle1')) }}

                            {{ Form::label('exampleInputTitle', 'Meta Keyword:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Meta Keyword is required")) }}
                            {{ Form::text('meta_keyword',null, array('class' => 'form-control','placeholder' => 'Enter Meta Keyword','id' => 'exampleInputTitle1')) }}                                                                                                        
                        </div>
                        <div class="form-group">
                            {{ Form::checkbox('enabled',null, array('class' => 'form-control')) }} 
                            {{ Form::label('enabled', 'Enabled ?',array('data-toggle'=>"tooltip", 'data-original-title'=>"Enabled ?")) }}
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo URL::to('/'); ?>/backend/maincategory/create" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</a>

                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-camera"></i> ADD</button>
                </div>
          {{ Form::close() }}
        </div><!-- /.box -->
    </div>
</div>
@stop