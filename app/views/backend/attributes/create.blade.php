@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-cogs"></i>
                <h3 class="box-title">Add Attribute</h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Go Back">
                    <li class="pull-right"><a href="{{URL::route('backend.attributes.index')}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>
                </div>
            </div>
            @if(isset($attribute->id))
            {{ Form::model($attribute, ['route' => ['backend.attributes.update', $attribute->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            @else
            {{ Form::model($attribute, ['route' => ['backend.attributes.create'],  'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            @endif
            <div class="box-body">
                @if ($errors->all() != null)
                <ul class="error">
                    @foreach($errors->all() as $err)
                    <li>{{$err}}</li>
                    @endforeach
                </ul>
                @endif
				<div class="form-group">
					<?php 
					$attributegroup[] = '';
					foreach($attribute_group as $groupkey => $groupval) { 
						$attributegroup[$groupval['id']] = $groupval['group_name'];
					}
					?>
					{{ Form::label('attribute_group', 'Attribute Group*',array('data-toggle'=>"tooltip", 'data-original-title'=>"The Attribute group will be shown as Fabric, Leg Color and Stud")) }}
                    {{ Form::select('attribute_group', $attributegroup) }}
				</div>
                <div class="form-group">
                    {{ Form::label('name', 'Name*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Name is required")) }}
                    {{ Form::text('name',null, array('class' => 'form-control','placeholder' => 'Enter Name')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Description',array('data-toggle'=>"tooltip", 'data-original-title'=>"Description is Optional")) }}
                    {{ Form::text('description',null, array('class' => 'form-control','placeholder' => 'Enter Description')) }}
                </div>
				<!-- <div class="form-group">
					 {{ Form::label('has_price', 'Is this Attribute has price?*',array('data-toggle'=>"tooltip", 'data-original-title'=>"If it is Yes then each attribute will have price field.")) }}
                    {{ Form::radio('has_price', 'Yes', '', array('id' => 'has_price_yes', 'class'=>'haspriceinput')) }} Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{ Form::radio('has_price', 'No', '', array('id' => 'has_price_no', 'class'=>'haspriceinput')) }} No	
				</div> -->
				{{ Form::hidden('has_price', '', array('id'=>'has_price')) }} 
				<div id="price_options"> 
					<div class="form-group">
						{{ Form::label('attribute_type', 'Attribute Type*',array('data-toggle'=>"tooltip", 'data-original-title'=>"The Attribute value will be shown as Dropdown, Radio, Color selector, Text or Check")) }}
						{{ Form::select('attribute_type',array(''=>'', 'Checkbox'=>'Checkbox', 'Color'=>'Color', 'Dropdown'=>'Dropdown', 'Image'=>'Image', 'Label'=>'Label', 'Radio'=>'Radio')) }}
						{{ Form::hidden('atype_defval', $attribute->attribute_type) }}
					</div>
					<div class="form-group">
						 {{ Form::label('price_mode', 'The Attribute price same for all products*',array('data-toggle'=>"tooltip", 'data-original-title'=>"If it is Yes then each attribute mode will have price field.")) }}
						{{ Form::checkbox('price_mode', 'Common', '', array('id' => 'price_mode_yes')) }} Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						{{ Form::checkbox('price_mode', 'Different', '', array('id' => 'price_mode_no')) }} No	
					</div>
					<div class="form-group">
						 {{ Form::label('price_value', 'Attribute price*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Fixed or Percentage value will be used in price calculation.")) }}
						{{ Form::checkbox('price_value', 'Fixed', '', array('id' => 'price_value_fixed')) }} Fixed &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						{{ Form::checkbox('price_value', 'Percentage', '', array('id' => 'price_value_percentage')) }} Percentage	
					</div>
					<div class="form-group">
						{{ Form::label('attribute_type_image', 'Attribute Image',array('data-toggle'=>"tooltip")) }}
						{{ Form::file('attribute_type_image') }}
						@if(isset($attribute->id))
						@if(isset($attribute['attributes']['attribute_image']))
							<a href='{{URL::to('/')}}/uploads/attributes/{{ $attribute['attributes']['attribute_image'] }}' target='_blank'><?php echo($attribute['attributes']['attribute_image']);?></a>
						@endif
						{{ Form::hidden('attribute_type_image_exist', $attribute['attributes']['attribute_image']) }}
						@endif
							
					</div>
					 
				</div>
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

		$('#attribute_group').on('change', function() {
			PriceAttr();
		});
		function PriceAttr() {
			attrgr = $('#attribute_group').val();
			//$('#price_value_fixed, #price_value_percentage').iCheck('uncheck');
			$('#price_value_fixed, #price_value_percentage').iCheck('enable');
			if(attrgr == '3') {
				$('#attribute_type').val('Checkbox');
				//$('#attribute_type').attr('readonly','readonly');
				$('#attribute_type option:not(:selected)').attr('disabled', true);
			} else {
				//$('#attribute_type').val($('#atype_defval').val());
				$('#attribute_type option').attr('disabled', false);
			}
			if(attrgr == '5') {
				$('#has_price').val('No');
				$('#price_options').hide();
			} else {
				if(attrgr == '4') {
					$('#price_value_fixed').iCheck('check');
					$('#price_value_percentage').iCheck('disable');
				}
				$('#has_price').val('Yes');
				$('#price_options').show();
			}
		}
		
		PriceAttr();
	});



@stop