<h3 class="box-title">Edit Product</h3>
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
        {{ Form::label('price', 'Price') }}
        {{ Form::text('price',null, array('class' => 'form-control','placeholder' => 'Enter Price')) }}
    </div>
    <div class="form-group">
        {{ Form::label('quantity', 'Quantity') }}
        {{ Form::text('quantity',null, array('class' => 'form-control','placeholder' => 'Enter Quantity')) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description',null, array('class' => 'form-control','placeholder' => 'Enter Description')) }}
    </div>

    <!-- <div class="form-group ">
        {{ Form::label('image', 'Upload Image:') }} 
        <label for="file">Upload Image:</label>
        <input type="file" name="image" id="file"> 
        <p>Max 2MB and resolution of 436*654.</p>                   
        <span class="errorRed"></span>
    </div> -->
    
    <div id="catgory_selects">
        
        <div class="form-group">
            {{ Form::label('parent_category', 'Parent Category') }}
            <select class="form-control" name="parent_category_id">
                
                @foreach($tree as $key=>$parent)
                @if($product->parent_category_id == $parent['id'])                                        
                    
                    <option value="{{$parent['id']}}" data-count="{{$key}}" >{{$parent['name']}}</option>
                
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group" >
            {{ Form::label('category', 'Category') }}
            <?php foreach($tree as $key=>$parent)  {?>
                <?php if($product->parent_category_id == $parent['id']) {?>                        
                    <?php if(isset($parent['children'])){?>
                        <?php foreach($parent['children'] as $firstchild){?>
                            <?php if($product->category_id == $firstchild['id']){?>
                                <?#php echo $firstchild['name'];?>
                                <select class="form-control" name="category_id">                 
                                    <option value="{{$category['id']}}" data-count="{{$key}}" >{{$category['name']}}</option>                                        
                                </select>                                                        
                                <?php }?>                            
                        <?php }?>
                    <?php }?>
                <?php }?>
            <?php }?>            
        </div>           
    </div>
    <div class="form-group">
        {{ Form::checkbox('enabled', '1',array('checked')) }}
        {{ Form::label('enabled', 'Enabled') }}
    </div>
    <div class="form-group">
        {{ Form::checkbox('out_of_stock', '1') }}
        {{ Form::label('out_of_stock', 'Out of Stock') }}
    </div>    
    <div class="box-footer"  id="test">
        {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
        {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
    </div>
</div>
{{ Form::close() }}