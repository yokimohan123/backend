@extends('layouts.backend')
@section('content')
<a class="btn bg-olive btn-flat margin" style="float:right;" href="<?php echo URL::to('/'); ?>/backend/designer/edit">Edit info</a>
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-body table-responsive">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
<!--                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Image</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Description</th>-->
                                
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php foreach ($block as $design) { ?>
                            <tr> 
                                <td><img src="<?php echo URL::to('/images/'); ?>/<?php echo $design['image']; ?>" alt="" /></td>   
                            </tr>
                            <tr><td><?php echo $design['content']; ?></td></tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop
