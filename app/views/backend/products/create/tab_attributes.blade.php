<h3 class="box-title">Attributes</h3>
@if(isset($product->id))
    {{ Form::model($product, ['route' => ['backend.products.attributes', $product->id], 'method' => 'post']) }}
@endif

<div class="box-body">
	@foreach($attribute_master as $attributemaster) 
		<?php $count = 1; ?>
		
			<div class="row-fluid show-grid">
				<div><strong><?php echo $attributemaster['name'];?></strong></div>
				<?php 
				if(count($attributemaster['attribute_values']) > 0) { 
					foreach($attributemaster['attribute_values'] as $attr_key => $attr_val) {
						$check_box_flag = false;
						foreach ($product->product_attributes as $attributes) {
							if($attr_val['id'] == $attributes->attribute_value_id) {
								$check_box_flag = true;
								break;
							}
						}
				?>
						<div class="col-md-3">{{ Form::checkbox('attribute_value[]', $attr_val['id'], $check_box_flag) }} {{ Form::label('attribute_value', $attr_val['value']) }}</div>
					<?php 
						if($count % 4 == 0) {
							echo '</div><div class="row-fluid show-grid">';
						}
						$count++;
					?>
			<?php 
					}
				} else { ?>
					<p class='text-info'>Attribute values not created yet.</p>
			<?php } ?>
			</div>
		
	@endforeach
	
	
    
    <div class="box-footer">
        {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
        {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
    </div>
</div>
{{ Form::close() }}	