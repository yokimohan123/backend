@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{(isset($parent))?"Categories Under ".$parent['name']:"Main Categories"}}</h3>
                <div class="box-tools pull-right">
                    <li class="pull-right">
                        @if (isset($parent))
                        <a href="{{URL::route('backend.categories.create',$parent->id)}}" class="text-muted btn btn-default btn-sm"><i class="fa fa-plus"></i> Create new</a>                        
                        @endif
                    </li>
                </div>
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
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Name</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Description</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Slug</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Action</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="">{{$category['name']}}</td>
                                    <td class="">{{$category['description']}}</td>
                                    <td class="">{{$category['slug']}}</td>
                                    <!-- <td class="">
                                        <a href="">Sub Categories</a> | 
                                        <a href="<?php echo URL::to('/backend'); ?>/maincategory/edit/<?php echo $category['id']; ?>">Edit</a> | 
                                        <a href="<?php echo URL::to('/backend'); ?>/maincategory/delete/<?php echo $category['id']; ?>">Delete</a>
                                    </td> -->
                                    <td class="">
                                        <a href="{{URL::route('backend.productlist.list',array('id'=>$category['id']))}}">View Products</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop