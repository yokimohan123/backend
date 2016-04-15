@extends('layouts.backend')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Footer Social Icons</h3>
            </div><!-- /.box-header -->
<!--            <p><?php echo $errors->first('link'); ?></p>-->
            
            @if ($errors->has())        
                @foreach ($errors->all() as $error)
                <ul style="color:red;">
                        {{ $error }} 
                </ul>        
                @endforeach     
        @endif
            
            <!-- form start -->
            <form action="{{URL::route('backend.socialicon')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            <label>Facebook:</label>
                                <input type="text" name="footer_facebook" class="form-control" value ="<?php echo $block[0]['link']; ?>">                           
                                @if ($errors->has('link')) <p class="help-block">{{ $errors->first('link') }}</p> @endif
                            <!-- <label>Pinterest:</label>
                                <input type="text" name="footer_pinterest" class="form-control" value ="<?php echo $block[1]['link']; ?>"> 
                                @if ($errors->has('link')) <p class="help-block">{{ $errors->first('link') }}</p> @endif -->
                            <!-- <label>Instagram:</label>
                                <input type="text" name="footer_instagram" class="form-control" value ="<?php echo $block[2]['link']; ?>">
                                @if ($errors->has('link')) <p class="help-block">{{ $errors->first('link') }}</p> @endif -->
                            <label>Twitter:</label>
                                <input type="text" name="footer_twitter" class="form-control" value ="<?php echo $block[3]['link']; ?>"> 
                                @if ($errors->has('link')) <p class="help-block">{{ $errors->first('link') }}</p> @endif
                            <label>Linkedin:</label>
                                <input type="text" name="footer_linkedin" class="form-control" value ="<?php echo $block[4]['link']; ?>">                           
                                @if ($errors->has('link')) <p class="help-block">{{ $errors->first('link') }}</p> @endif
                         </div> 
                    </fieldset>

                </div>
                <div class="modal-footer clearfix">

                    <a href="<?php echo URL::to('/'); ?>/backend" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</a>

                    <button type="submit" class="btn btn-primary pull-left">Submit Block</button>
                </div>
            </form> 
        </div><!-- /.box -->
    </div>
</div>
@stop