<h3 class="box-title">SEO Information</h3>
@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif
@if(isset($product->id))
    {{ Form::model($product, ['route' => ['backend.products.seo', $product->id], 'method' => 'patch']) }}
@endif
<div class="box-body">
    <div class="form-group">
        {{ Form::label('meta_title', 'Meta Title') }}
        {{ Form::text('meta_title',null, array('class' => 'form-control','placeholder' => 'Enter Meta Title')) }}
    </div>
    <div class="form-group">
        {{ Form::label('meta_description', 'Meta Description') }}
        {{ Form::text('meta_description',null, array('class' => 'form-control','placeholder' => 'Enter Meta Description')) }}
    </div>
    <div class="form-group">
        {{ Form::label('meta_keyword', 'Meta Keywords') }}
        {{ Form::text('meta_keyword',null, array('class' => 'form-control','placeholder' => 'Enter Meta Keywords')) }}
    </div>
    <div class="box-footer">
        {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
        {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
    </div>
</div>
{{ Form::close() }}