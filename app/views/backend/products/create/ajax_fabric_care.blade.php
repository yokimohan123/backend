<div class="row-fluid show-grid">
    @foreach($fabricCareSymbols as $symbols)
    	<!-- {{$check_box_flag = false}} -->
    	@foreach($ProductFabricCare as $fabricCare)
			@if($fabricCare['fabrics_care_symbol_id'] == $symbols['id'])
				<!-- {{$check_box_flag = true}} -->
				<?php break; ?>
			@endif
    	@endforeach
        <div class="col-md-3">
            {{ Form::checkbox('symbols_value[]', $symbols['id'], $check_box_flag,array('id'=> $symbols['id'])) }}
            <img src="{{URL::to('/')}}/uploads/fabric_care/symbols/{{$symbols['image']}}">
            {{ Form::label('symbols_value', $symbols['name']) }}
        </div>				                                             
    @endforeach
</div>