@extends('layouts.backend')
@section('content')
<a class="btn bg-olive btn-flat margin" style="float:right;" href="<?php echo URL::to('/'); ?>/backend/collection/create">Add New Collections</a>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Collections</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Image</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Title</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Alt tag</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Actions</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php foreach ($slides as $collection) { ?>
                                <tr>
                                    <td class=""><img src="{{URL::to('/')}}/uploads/collections/cover/{{$collection['id']}}/{{ $collection['image']}}" class="resizeHomePageAdminImage"></td>
                                    <td class=""><?php echo $collection['title']; ?></td>
                                    <td class=""><?php echo $collection['alt']; ?></td>
                                    <td class="">
                                        <a href="{{URL::to('/')}}/backend/collection/edit/{{$collection['id']}}">Edit</a> |
                                        <a href="<?php echo URL::to('/backend'); ?>/collection/delete/<?php echo $collection['id']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop