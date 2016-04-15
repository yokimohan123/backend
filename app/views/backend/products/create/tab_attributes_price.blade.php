<h3 class="box-title">Attributes Price</h3>

<div class="box-body">
	@if (count($product_price_attributes) > 0)
		@foreach ($product_price_attributes as $k => $product_price_attribute)
			<?php 
			$attribute_price[$product_price_attribute['attribute_name']]['values'][$product_price_attribute['attribute_value_id']] = $product_price_attribute['attribute_value'];
			$attribute_price[$product_price_attribute['attribute_name']]['mode'] = $product_price_attribute['price_mode'];
			$attribute_price[$product_price_attribute['attribute_name']]['modeval'] = $product_price_attribute['price_value'];
			
			?>
		@endforeach
	
		@if(isset($product->id))
			{{ Form::model($product, ['route' => ['backend.products.attributesprice', $product->id], 'method' => 'post']) }}
			<?php 
				foreach($attribute_price as $param => $attrval) {
					$product['product_attribute_prices']
					
				?>
					<div class="row-fluid show-grid">
						<div><strong><?php echo $param;?></strong></div>
							<?php if($attrval['mode'] == 'Different') { ?>
								<table class="table table-bordered table-hover" id="tab_logic">
									<?php 
										if($attrval['modeval'] == 'Fixed') {
											$curr_sym = '£';
											$val_sym = '';
										} else {
											$curr_sym = '';
											$val_sym = '%';
										}
										foreach($attrval['values'] as $attrid => $attrval) { 
											$def_val = '';
											foreach ($product->product_attribute_prices as $attributes_price) {
												if($attrid == $attributes_price->attribute_value_id) {
													$def_val = number_format($attributes_price->price,2);
													break;
												}
											}
										?>
										<tr id='addr0'>
											<td>{{ Form::label('attribute_price[]', $attrval) }}</td>
											<td><span>{{$curr_sym}}</span> {{ Form::text('attribute_price[]',$def_val, array('class' => 'form-control form-control-extend','placeholder' => 'Enter Price Value')) }} {{ Form::hidden('attribute_value_id[]',$attrid) }} <span>{{$val_sym}}</span></td>
										</tr>
									<?php } ?>
								</table>
							<?php } else { 
								echo '<p class="text-info">The attribute price for all '.$param. ' is same.</p>';
								
							} ?>
					</div>
				<?php
				}
			?>
			<div class="box-footer">
				{{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
				{{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
			</div>
		@endif
	@else
		Please select Attributes for the product. 
	@endif
	
</div>
{{ Form::close() }}	