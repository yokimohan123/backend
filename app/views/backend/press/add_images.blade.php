@extends('layouts.backend')
@section('content')
<a href="<?php echo URL::to('/'); ?>/backend/press" class="btn bg-olive btn-flat margin" style="float:right;">Go Back</a>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add New Images</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo URL::to('/'); ?>/backend/press/store" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="file">Upload Slider:</label>
                        <input type="file" name="image" id="file"> 
                        <p>Max 2MB and resolution of 391*510.</p>                   
                        <span class="errorRed"></span>
                    </div>

                    <fieldset>
                        <div class="form-group">
                            <label for="exampleInputTitle">Title:</label>
                            <input type="text" name="title" class="form-control" id="exampleInputTitle1" value="">                            
                            <label for="exampleInputTitle">Alt Tag:</label>
                            <input type="text" name="alt" class="form-control" id="exampleInputTitle1" value=""><br><br>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo URL::to('/'); ?>/backend/press/create" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</a>

                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-camera"></i> Upload Now</button>
                </div>
            </form> 
        </div><!-- /.box -->
    </div>
</div>
@stop