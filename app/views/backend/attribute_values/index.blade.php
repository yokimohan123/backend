@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-cogs"></i>
                <h3 class="box-title">Attribute Values</h3>
                <div class="box-tools pull-right">
                    <li class="pull-right"><a href="{{URL::route('backend.attribute_values.new')}}" class="text-muted btn btn-default btn-sm"><i class="fa fa-plus"></i> Create new</a></li>
                </div>
            </div>
            <div class="box-body">
				<!-- Message for CSV Import -->
				@if(Session::has('update_result'))
					<div class="alert alert-success">
						{{ Session::get('update_result') }}
					</div>
				@endif
                <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Id</th>
                            <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Name</th>
                            <!-- <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="40%">Attribute Value count</th> -->
                            <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="12%">Action</th>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach ($attribute_values as $attribute)
                            <tr>
                                <td>{{$attribute['id']}}</td>
                                <td>{{$attribute['name']}}</td>
                                <!-- <td>{{$attribute['attribute_value_count']}}</td> -->
                                <td class="">
                                    <a href="{{URL::route('backend.attribute_values.edit',array('id'=>$attribute['id']))}}" class="btn-sm btn-warning" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                   <!--  <a href="{{URL::route('backend.attribute_values.delete',array('id'=>$attribute['id']))}}" class="btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-fw fa-trash-o"></i></a> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
				{{$attribute_values->links()}}
            </div>
        </div>
    </div>
</div>
@stop

