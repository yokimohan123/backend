@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-cogs"></i>
                <h3 class="box-title">{{ $category_name->name }} - CSV Import</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Go Back">
                    <li class="pull-right"><a href="{{URL::route('backend.productlist.list', array('category_id'=>$category_id))}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>
                </div>
            </div>
			<div class="box-body">
				<!-- Message for CSV Import -->
				@if(Session::has('import_result'))
					<div class="alert {{ Session::get('class_name') }}">
						{{ Session::get('import_result') }}
					</div>
				@endif
				
				{{ Form::model($product, ['route' => ['backend.products.importdata'], 'method' => 'post', 'files' => true]) }}
				
					@if ($errors->all() != null)
						<ul class="error">
							@foreach($errors->all() as $err)
							<li>{{$err}}</li>
							@endforeach
						</ul>
					@endif
					<div class="form-group">
						{{ Form::label('name', 'Browse File*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Choose a file")) }}
						{{ Form::file('csv_import',null, array('class' => 'form-control','placeholder' => 'Select CSV file')) }}				
						{{ Form::hidden('category_id', $category_id, array('id'=>'category_id')) }}
					</div>
					<div class="box-footer">
						{{ Form::button('Import Data',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
						
					</div>
					
				{{ Form::close() }}
				
			</div>
		</div>
	</div>
</div>
@stop

