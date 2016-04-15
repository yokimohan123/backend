<h3 class="box-title">Used Care Symbols</h3> 
<div class="box-body">
    @if(isset($product_fabric_care) > 0)
        @foreach($product_fabric_care as $care)
               
                <h4 class="box-title">{{$care['name']}}</h4>
                <div class="row-fluid show-grid" id="drag-drop-care-symbols">
                {{ Form::open( ['route' => ['backend.products.caresymbols'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                <ul name="position" class="testFabrics">
                    @foreach($product_fabric_symbols as $symbols)
                        @if($symbols['fabrics_care_id'] == $care['id'])
                                <div id="listCare_{{$symbols['id']}}" class="col-md-2">
                                <li >
                                    <img src="{{URL::to('/')}}/uploads/fabric_care/symbols/{{$symbols['image']}}" title="{{$symbols['name']}}" alt="{{$symbols['name']}}" data-toggle="tooltip">{{$symbols['name']}}
                                </li>
                               
                            </div>
                        @endif
                    @endforeach
                    </ul>
                    {{ Form::close() }}
                </div>
                
        @endforeach
    @endif
</div>
<h3 class="box-title">Fabric Care</h3>
    <div class="box-body">
        {{ Form::open(['route' => ['backend.fabric.product.create'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
        <div class="form-group" name="position_id">
            {{Form::hidden('product_id', $product->id, array('id'=>'id','class'=>'fabric-text-product-id')) }}
            {{Form::select('fabric_care', array('default' => 'Please Select') + $fabricCare, NULL, array('class'=>'form-control fabric-selec-box'),'default')}}        
        </div>
        <div class="fabric_care_symbols"></div> <!-- Check box from ajax -->
        <div class="box-footer">
            {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
        </div>
        {{Form::close()}}
    </div>




