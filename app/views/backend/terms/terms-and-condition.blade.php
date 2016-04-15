@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Terms and Condition</h3>
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
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Title</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Slug</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Desctiption</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Action</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <tr>
                                    <td class="">{{$terms->title}}</td>
                                    <td class="">{{$terms->slug}}</td>
                                    <td class="">{{$terms->content}}</td>
                                    <td class="">
                                        <a href="<?php echo URL::to('/backend'); ?>/terms-and-condition/edit">Edit</a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop