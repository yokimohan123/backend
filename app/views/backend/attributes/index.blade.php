@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-cogs"></i>
                <h3 class="box-title">Attributes</h3>
                <div class="box-tools pull-right">
                    <li class="pull-right"><a href="{{URL::route('backend.attributes.new')}}" class="text-muted btn btn-default btn-sm"><i class="fa fa-plus"></i> Create new</a></li>
                </div>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="8%">Id</th>
                            <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="20%">Name</th>
                            <!-- <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="20%">Group</th> -->
							<!-- <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="20%">Is same price?</th> -->
						    <!-- <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="20%">Price value?</th> -->
                            <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="12%">Action</th>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                   
                        @foreach ($attributes as $attribute)
                            <tr>
                                <td>{{$attribute['id']}}</td>
                                <td>{{$attribute['name']}}</td>
                                <!-- <td>{{$attribute['group_name']}}</td> -->
								<!-- <td> -->
								<!-- @if($attribute['price_mode'] == 'Common')
									{{ "Yes" }}
								@endif
								@if($attribute['price_mode'] == 'Different')
									{{ "No" }}
								@endif -->
								<!-- </td> -->
								 <!-- <td>{{$attribute['price_value']}}</td> -->
                                <td class="">
                                    <a href="{{URL::route('backend.attributes.edit',array('id'=>$attribute['id']))}}" class="btn-sm btn-warning" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                    <a href="{{URL::route('backend.attributes.delete',array('id'=>$attribute['id']))}}" class="btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-fw fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                   
                    </tbody>
                </table>
				{{$attribute_paginate->links()}}
            </div>
        </div>
    </div>
</div>
@stop

