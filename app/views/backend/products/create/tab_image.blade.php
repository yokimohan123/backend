<h3 class="box-title">Images</h3>
{{ Form::model($product, ['route' => ['backend.products.images', $product->id], 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id'=>'images']) }}{{ Form::close() }}
<div>
    @foreach ($product->product_images as $image)
    <div style="float: left;margin-left: 10px;width:250px;padding:5px;border:1px solid #ccc;border-radius:5px;">
        <img src="{{URL::to('/')}}/uploads/products/medium/{{$product->id}}/{{$image->image_path}}" width="240" />
        @if(isset($product->id))
            {{ Form::model($product, ['route' => ['backend.products.images',$product->id,$image->id], 'method' => 'patch']) }}
        @else
            {{ Form::open(['route' => 'backend.products.create']) }}
        @endif
        <br />
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('title', 'Title Tag') }}
                {{ Form::text('title',$image->title, array('class' => 'form-control','placeholder' => 'Enter Title Tag')) }}
            </div>
            <div class="form-group">
                {{ Form::label('alt', 'Alt Tag') }}
                {{ Form::text('alt',$image->alt, array('class' => 'form-control','placeholder' => 'Enter Alt Tag')) }}
            </div>
            
            <div class="box-footer">
                {{ Form::button('Update',array('class'=>'btn btn-success','type' => 'submit')) }}
                {{ Form::button('Delete',array('class'=>'btn btn-danger','name'=>'delete','value'=>'1','type' => 'submit')) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @endforeach
    <div class="clearfix"></div>
</div>