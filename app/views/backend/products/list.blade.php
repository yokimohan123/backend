@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Products</h3>
                <div class="box-tools pull-right">
					<li class="pull-right"><a href="{{URL::route('backend.products.csvimport', $category_id, 'category_id')}}" class="text-muted btn btn-default btn-sm"><i class="fa fa-plus"></i> Import products from CSV</a></li>
                    <li class="pull-right"><a href="{{URL::route('backend.products.new', $category_id, 'category_id')}}" class="text-muted btn btn-default btn-sm"><i class="fa fa-plus"></i> Create new</a></li>
                </div>
            </div><!-- /.box-header -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
			<div class="box-body row catalog_search">
				<div class="col-lg-12">
					<div class="input-group">
					  <input type="text" class="form-control" name='catalog_keyword' id='catalog_keyword' placeholder="Search in Name and Slug">
					  <span class="input-group-btn">
						<button class="btn btn-default search_reset" type="button">Reset</button>
					  </span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-12 -->
			</div>
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
											<a href="{{URL::to('/')}}/backend/products/delete/<?php echo $product['id']; ?>">Delete</a>
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
        </div><!-- /.box -->
    </div>
</div>
@stop
@section('javascript')
	$(function() {
		$('#catalog_keyword').keyup(function() {
			var kw = $(this).val();
			var cid = '{{ $category_id }}'
			if(kw != '') {
				//console.log(kw)
				$.ajax({
				  method: "POST",
				  url: "{{ route('backend.products.search') }}",
				  data: { keyword: kw, category_id: cid }
				})
				.done(function( response ) {
					$('.product_listing').html(response);
				});
			}
		});
		
		$('.search_reset').click(function () {
			location.reload();
		});
	}); 
@stop
