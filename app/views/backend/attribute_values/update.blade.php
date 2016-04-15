@extends('layouts.backend')
@section('content')
<?php 
foreach($attribute_values as $attribute_value) { 
	$attribute_group_value[] = $attribute_value['attributes'];
	
} 
$price_mode = $attribute_value['price_mode'];
$price_value = $attribute_value['price_value'];
if($price_mode == 'Common') {
	$show_price_td = 'true';
	$colspan = '3';
} else {
	$show_price_td = 'false';
	$colspan = '2';
}
if($price_value == 'Fixed') {
	$curr_sym = Config::get('constants.Currency_Symbol');
	$val_sym = '';
} else {
	$curr_sym = '';
	$val_sym = '%';
}
?>
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
            
            {{ Form::model($attribute_values, ['route' => ['backend.attribute_values.update'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            
            <div class="box-body">
                @if ($errors->all() != null)
                <ul class="error">
                    @foreach($errors->all() as $err)
                    <li>{{$err}}</li>
                    @endforeach
                </ul>
                @endif
				
                <div class="form-group">
                    <table class="table table-bordered table-hover" id="tab_logic">
						<tr id='addr0'>
							<td>{{ Form::label('attribute_id', 'Attrbute Name',array('data-toggle'=>"tooltip", 'data-original-title'=>"Attribute Type is required")) }}</td>
							<td colspan="{{$colspan}}">{{ Form::label('attribute_id', $attribute_value['name']) }}</td>
							<td></td>
						</tr>
						<tr id='addr0'>
							<td>{{ Form::label('attribute_id', 'Attrbute Id',array('data-toggle'=>"tooltip", 'data-original-title'=>"Attribute Type is required")) }}</td>
							<td colspan="{{$colspan}}">{{ Form::label('attribute_id', $attribute_value['attribute_type_id']) }}{{ Form::hidden('attribute_id', $attribute_value['attribute_type_id']) }} {{ Form::hidden('price_mode', $price_mode) }}</td>
							 <td></td>
						</tr>
						<?php 
						$i=1;
						
						foreach($attribute_group_value as $k => $v) { ?>
							<tr id='addr1'>
								<td>
									{{ Form::label('value', 'Attribute Value id '.$v['attribute_value_id'],array('data-toggle'=>"tooltip", 'data-original-title'=>"Value for selected attribute")) }}
								</td>
								<td>
									{{ Form::text('value_'.$i, $v['value'], array('class' => 'form-control','placeholder' => 'Enter Attribute Value')) }}
									{{ Form::hidden('attribute_value_'.$i, $v['attribute_value_id']) }}
								</td>
								<td>
									{{ Form::file('image_'.$i) }}
									
									@if(isset($v['image']))
										<a href='{{URL::to('/')}}/uploads/attribute_values/{{$v['attribute_type_id']}}/{{ $v['image'] }}' target='_blank'><?php echo($v['image']);?></a>
									@endif
									{{ Form::hidden('attribute_value_image_exist_'.$i, $v['image']) }}
									
								</td>
								<?php if($show_price_td == 'true') { ?>
									<td>
										<span>{{ $curr_sym }}</span> {{ Form::text('price_'.$i, $v['price'], array('class' => 'form-control form-control-extend','placeholder' => 'Enter Attribute Price Value')) }} <span>{{ $val_sym }}</span>
									
									</td>																	
								<?php } ?>	
								<?php if($v['attribute_type_id'] == 2) { ?>
									<td>
										{{ Form::label('color', 'Color:',array('data-toggle'=>"tooltip", 'data-original-title'=>"Color is required")) }}
                                            {{ Form::input('color','color_'.$i,$v['color'], array('class' => 'form-control-color','placeholder' => 'Enter Color','id' => 'exampleInputTitle1')) }}             
									
									</td>																	
								<?php } ?>	
								<td>
										<a href="{{URL::route('backend.attribute_values.delete',array('id'=>$v['attribute_value_id']))}}" class="btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-fw fa-trash-o"></i></a>
								</td>												
							</tr>
							<tr id='addr2'></tr>
						<?php 
							$i++;
						} ?>
						{{ Form::hidden('row_count', $i-1) }}
						{{ Form::hidden('price_validation', $show_price_td) }}
					</table>
                </div>
                
				<div class="form-group">&nbsp;</div>
                <div class="box-footer">
                    {{ Form::button('Update',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
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
		
	});
@stop