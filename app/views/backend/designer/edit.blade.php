@extends('layouts.backend')
@section('content')
<a href="<?php echo URL::to('/'); ?>/backend/aboutdesigner" class="btn bg-olive btn-flat margin" style="float:right;">Go Back</a>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit About Designer</h3>
            </div><!-- /.box-header -->

            @if ($errors->has())        
            @foreach ($errors->all() as $error)
            <ul style="color:red;">
                {{ $error }}
            </ul>
            @endforeach     
            @endif
            <?php foreach ($block as $design) { ?>
            <!-- form start -->
            <form action="<?php echo URL::to('/'); ?>/backend/about_designer/update_info/<?php echo $design['id']; ?>" method="post" enctype="multipart/form-data">
                
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            <label>About Designer</label>                         
                            <textarea name="content" class="form-control"><?php echo $design['content']; ?></textarea>
                            @if ($errors->has('content')) <p class="help-block">{{ $errors->first('content') }}</p> @endif
                        </div>
                    </fieldset>
                    <div class="form-group ">
                        <label for="file">Upload Image:</label>
                        <input type="file" name="image" id="file"> 
                        <p>Upload to replace the below image, Max 2MB and resolution of 448*674.</p>                   
                        <span class="errorRed"></span>
                        <img src="<?php echo URL::to('/images/'); ?>/<?php echo $design['image']; ?>" alt="" />
                    </div>
                    
                </div>
                <div class="modal-footer clearfix">

                    <a href="{{URL::to('/')}}/backend/designer/edit" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</a>

                    <button type="submit" class="btn btn-primary pull-left">Submit Block</button>
                </div>
                
            </form>
            <?php } ?>
        </div><!-- /.box -->
    </div>
</div>
@stop
