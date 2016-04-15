@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-cogs"></i>
                <h3 class="box-title">Add Attribute Values</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Go Back">
                    <li class="pull-right"><a href="{{URL::route('backend.attribute_values.index')}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>
                </div>
            </div>
            {{ Form::model($attribute_values, ['route' => ['backend.attribute_values.create'],  'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            
            <div class="box-body">
                @if ($errors->all() != null)
                <ul class="error">
                    @foreach($errors->all() as $err)
                    <li>{{$err}}</li>
                    @endforeach
                </ul>
                @endif
				<?php
				$attributes[0] = '';
				foreach($attribute_names as $attribute_name) {
					$attributes[$attribute_name->id] =  $attribute_name->group_name.' > '.$attribute_name->name;
					$attribute_js_names[$attribute_name->id] = $attribute_name->price_mode;
					$attribute_js_price_val[$attribute_name->id] = $attribute_name->price_value;
				}
				?>
                <div class="form-group">
                    <table class="table table-bordered table-hover" id="tab_logic">
						<tr id='addr0'>
							<td>{{ Form::label('attribute_id', 'Attrbute Name*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Attribute Type is required")) }}</td>
							<td colspan="3">{{ Form::select('attribute_id', $attributes, null, array('class'=> 'ShowHidePrice')) }} {{ Form::hidden('sel_attribute_name', 'false', array('id'=>'sel_attribute_name')) }} {{ Form::hidden('sel_attribute_pval', 'Fixed', array('id'=>'sel_attribute_pval')) }}</td>
							 
						</tr>
							<tr id='addr3'>
								<td>
									{{ Form::label('color[]', 'Attribute Value 1',array('data-toggle'=>"tooltip", 'data-original-title'=>"Value for selected attribute")) }}
								</td>
								<td>
									{{ Form::label('color[]', 'Color:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Color is required")) }}
                                    {{ Form::input('color','color[]',null, array('class' => 'form-control-color','placeholder' => 'Enter Color','id' => 'exampleInputTitle1')) }}
								</td>
								<td>
									{{ Form::file('image[]') }}
								</td>
								<td class="attribute_price">
									<span class="valpricesym"></span> {{ Form::text('price[]',null, array('class' => 'form-control form-control-extend','placeholder' => 'Enter Price for Attribute Value')) }} <span class="valpriceper"></span>
								</td>
							</tr>
						
							<tr id='addr1'>
								<td>
									{{ Form::label('value', 'Attribute Value 1',array('data-toggle'=>"tooltip", 'data-original-title'=>"Value for selected attribute")) }}
								</td>
								<td>
									{{ Form::text('value[]',null, array('class' => 'form-control','placeholder' => 'Enter Attribute Value')) }}
								</td>
								<td>
									{{ Form::file('image[]') }}
								</td>
								<td class="attribute_price">
									<span class="valpricesym"></span> {{ Form::text('price[]',null, array('class' => 'form-control form-control-extend','placeholder' => 'Enter Price for Attribute Value')) }} <span class="valpriceper"></span>
								</td>
							</tr>
							<tr id='addr2'></tr>
						
					</table>
                </div>
                <div class="form-group">
						<a id="add_row" class="btn btn-default pull-left">Add Row</a>
						<a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
					
                </div>
				<div class="form-group">&nbsp;</div>
                <div class="box-footer">
                    {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
                    {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
@section('javascript')
	
	$(document).ready(function(){
		var i=2;
		var jsrr = new Array();
		var jspv = new Array();
		<?php 
			
			foreach($attribute_js_names as $k => $v) {
				echo 'jsrr['.$k.']="'.$v.'";';
				echo 'jspv['.$k.']="'.$attribute_js_price_val[$k].'";';
				//echo '\n';
			}
		?>
		//alert(jsrr.length)
		$("#add_row").click(function(){
			var price_fld_vis = $('#sel_attribute_name').val();
			if(price_fld_vis == 'true') {
				dis_play = 'block';
			} else {
				dis_play = 'none';
			}
			var colors = $('#attribute_id').val();

			if(colors == 2){
				new_row = '<td><label data-original-title="Value for selected attribute" data-toggle="tooltip" for="value">Attribute Value '+(i)+'</label></td><td><input name="color[]" type="color" class="form-control-color"></span></td><td><input name="image[]" type="file"></td><td class="attribute_price" style="display:'+dis_play+'"><span class="valpricesym"></span> <input type="text" name="price[]" placeholder="Enter Price for Attribute Value" class="form-control form-control-extend"> <span class="valpriceper">';
			}else{

			new_row = '<td><label data-original-title="Value for selected attribute" data-toggle="tooltip" for="value">Attribute Value '+(i)+'</label></td><td><input type="text" name="value[]" placeholder="Enter Attribute Value" class="form-control"></td><td><input name="image[]" type="file"></td><td class="attribute_price" style="display:'+dis_play+'"><span class="valpricesym"></span> <input type="text" name="price[]" placeholder="Enter Price for Attribute Value" class="form-control form-control-extend"> <span class="valpriceper"></span></td>';

			}
			
			$('#addr'+i).html(new_row);
			i++; 
			$('#tab_logic').append('<tr id="addr'+i+'"></tr>');
			updateCurrency();
		});
		$("#delete_row").click(function(){
			if(i>2){
				$("#addr"+(i-1)).html('');
				i--;
			}
		});
		$( ".ShowHidePrice" ).bind( "change", function() {
		
			//alert('calling...');
			var curval = $(this).val();
			if(jsrr[curval] == 'Common') {
				$('.attribute_price').show();
				attr_flag = 'true';
			} else {
				$('.attribute_price').hide();
				attr_flag = 'false';
			}
			attr_pval = jspv[curval]
			$('#sel_attribute_name').val(attr_flag);
			$('#sel_attribute_pval').val(attr_pval);
			updateCurrency();
		});
		function updateCurrency()
		{
			var pval_fld = $('#sel_attribute_pval').val();
			
			if(pval_fld == 'Fixed') {
				curr_sym = '£'
				val_sym = ''
			} else {
				curr_sym = ''
				val_sym = '%'
			}
			$('.valpriceper').html(val_sym);
			$('.valpricesym').html(curr_sym)
		}
	});

			$("#addr3").hide();
			$("#addr1").show();
			$('#attribute_id').change(function(){	        	
	        	if($(this).val() == 2){
	        		$("#addr3").show();
	        		$("#addr1").hide();
	        	}else{
	        		$("#addr3").hide();
	        		$("#addr1").show();
	        	}
	        	
	        	  
	    	});
	        	

	
	
@stop
