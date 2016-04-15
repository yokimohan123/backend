@extends('layouts.ajax')
@section('content')
	<div class="box-body table-responsive product_listing">
		<div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
			<div class="row">
				<div class="col-xs-6"></div>
				<div class="col-xs-6"></div>
			</div>
			
			
			<table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
				<thead>
					<tr role="row">
						<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Id</th>
						<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Name</th>
						<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="40%">Short Description</th>
						<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Slug</th>
						<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="12%">Action</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					if(count($products) > 0) { 
						foreach ($products as $product) { ?>
							<tr>
								<td>{{$product['id']}}</td>
								<td>{{$product['name']}}</td>
								<td>{{$product['short_description']}}</td>
								<td>{{$product['slug']}}</td>
								<td class="">
									<a href="{{URL::to('/')}}/backend/products/edit/<?php echo $product['id']; ?>">Edit</a> | 
									<a href="{{URL::to('/')}}/backend/products/delete/<?php echo $product['id']; ?>?page={{ $page }}">Delete</a>
								</td>
							</tr>
					<?php 
						}
					} else {
						echo '<tr><td colspan="5" class="alert alert-info">Products not found.</td></tr>';
					}
					?>
					
				</tbody>
			</table>
			
		</div>		
	</div><!-- /.box-body -->
        
@stop
