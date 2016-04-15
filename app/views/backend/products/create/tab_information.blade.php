<h3 class="box-title">Basic Information</h3>
@if(isset($product->id))
    {{ Form::model($product, ['route' => ['backend.products.update', $product->id], 'method' => 'patch']) }}
@else
    {{ Form::open(['route' => 'backend.products.create']) }}
@endif

@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif

@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
 @if(Session::has('flash_message'))
                            <p>{{Session::get('flash_message')}}</p>
                            @endif
{{ Form::hidden('id') }}
@if ($product->parent_category_id > 0)
    {{ Form::hidden('can_update_category',false) }}
@else
    {{ Form::hidden('can_update_category',true) }}
@endif
<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',null, array('class' => 'form-control','placeholder' => 'Enter Name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('slug', 'Slug') }}
        {{ Form::text('slug',null, array('class' => 'form-control','placeholder' => 'Enter Slug')) }}
    </div>
    <div class="form-group">
        {{ Form::label('reference', 'Reference') }}
        {{ Form::text('reference',null, array('class' => 'form-control','placeholder' => 'Enter Reference')) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('original_price', 'Original Price') }}
        {{ Form::text('original_price',null, array('class' => 'form-control','placeholder' => 'Enter Price')) }}
    </div>
    <div class="form-group">
        {{ Form::label('quantity', 'Quantity') }}
        {{ Form::text('quantity',null, array('class' => 'form-control','placeholder' => 'Enter Quantity')) }}
    </div>
    <div class="form-group">
        {{ Form::label('short_description', 'Short Description') }}
        {{ Form::text('short_description',null, array('class' => 'form-control','placeholder' => 'Enter Short Description')) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description',null, array('class' => 'form-control textarea','placeholder' => 'Enter Description')) }}
    </div>
    <?php if ($product->exists == 1) {?>
        <div class="form-group" id="click_for_select">
            {{ Form::label('Associated Categories') }}<br />
            <h4>
                <?php foreach($tree as $key=>$parent)  {?>
                    <?php if($product->parent_category_id == $parent['id']) {?>
                        <?php echo $parent['name'];?>
                        <?php if(isset($parent['children'])){?>
                            <?php foreach($parent['children'] as $firstchild){?>
                                <?php if($product->category_id == $firstchild['id']){?>
                                    >> <?php echo $firstchild['name'];?>                                
                                    <?php if(isset($firstchild['children'])){?>
                                        <?php foreach($firstchild['children'] as $lastchild){?>
                                            <?php if($product->child_category_id == $lastchild['id']) {?>
                                                >> <?php echo $lastchild['name'];?>
                                            <?php }?>
                                        <?php }?>
                                    <?php }?>
                                <?php }?>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                <?php }?>
            </h4>
            <a style="cursor: pointer;" id="click_to_change_category">Click here to change the categories.</a>
        </div>        
    <?php }?>
    
    <div id="catgory_selects">
		
        <div class="form-group">
            {{ Form::label('parent_category', 'Parent Category') }}
            <select class="form-control" id="parent_category" name="parent_category_id">
                
                @foreach($tree as $key=>$parent)
                    <option value="{{$parent['id']}}" data-count="{{$key}}" >{{$parent['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" id="hide_real_category">
            {{ Form::label('category', 'Category') }}
            <select class="form-control" id="real_category" name="category_id"></select>           
        </div>
        <div class="form-group" id="hide_child_category">
            {{ Form::label('child_category', 'Child Category') }}
            <select class="form-control" id="child_category" name="child_category_id"></select>
        </div>		
    </div>
    <div class="form-group">
        {{ Form::checkbox('new_tag', '1',array('checked')) }}
        {{ Form::label('new_tag', 'Is This product is consider as New?') }}
    </div>
    <div class="form-group">
        {{ Form::checkbox('sale_tag', '1',array('checked')) }}
        {{ Form::label('sale_tag', 'Is This product is consider as Sale?') }}
    </div>
    <div class="form-group">
        {{ Form::checkbox('enabled', '1',array('checked')) }}
        {{ Form::label('enabled', 'Enabled') }}
    </div>
    <div class="form-group">
        {{ Form::checkbox('out_of_stock', '1') }}
        {{ Form::label('out_of_stock', 'Out of Stock') }}
    </div>

    <div class="form-group offer-price-check">
        {{ Form::checkbox('offer_price_yes','1',array('checked')) }}
        {{ Form::label('offer_price_yes', 'Offer Price') }}
    </div>

    <div class="form-group enter-offer-price">
        {{ Form::label('offer_price', 'Offer Price') }}
        {{ Form::text('offer_price',null, array('class' => 'form-control','placeholder' => 'Enter Price')) }}
    </div>

	<!-- <div class="form-group">
        {{ Form::checkbox('installation_charges', '1') }}
        {{ Form::label('installation_charges', 'Installation Charges') }}
    </div> -->
	{{ Form::hidden('installation_charges',1) }}
    <div class="box-footer"  id="test">
        {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
        {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
    </div>
</div>
{{ Form::close() }}

