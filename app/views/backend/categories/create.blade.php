@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-cogs"></i>
                <h3 class="box-title">Add <?php echo (isset($parent)) ? "Category Under " . $parent['name'] : "Under Main Category"; ?></h3>
                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Go Back">
                    <li class="pull-right">
                        <a href="{{URL::route('backend.categories.index')}}" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a>
                    </li>
                </div>
            </div>
            @if(isset($category->id))
            {{ Form::model($category, ['route' => ['backend.categories.update', $category->id], 'method' => 'patch']) }}
            @else
            {{ Form::model($category, ['route' => ['backend.categories.store'], 'method' => 'post']) }}
            @endif
            <div class="box-body">
                @if ($errors->all() != null)
                <ul class="error">
                    @foreach($errors->all() as $err)
                    <li>{{$err}}</li>
                    @endforeach
                </ul>
                @endif
                @if(isset($parent))
                <input name="parent_id" value="{{$parent->id}}" type="hidden" />
                @endif
                <div class="form-group">
                    {{ Form::label('name', 'Category Name*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Name is required")) }}
                    {{ Form::text('name',null, array('class' => 'form-control','placeholder' => 'Enter Name')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('slug', 'Category Slug*',array('data-toggle'=>"tooltip", 'data-original-title'=>"Slug is required")) }}
                    {{ Form::text('slug',null, array('class' => 'form-control','placeholder' => 'Enter Slug')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Category Description',array('data-toggle'=>"tooltip", 'data-original-title'=>"Description is optional")) }}
                    {{ Form::textarea('description',null, array('class' => 'form-control','placeholder' => 'Enter Description')) }}
                </div>   
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
				<div class="form-group">
                    {{ Form::checkbox('enabled',null, array('class' => 'form-control')) }} 
                    {{ Form::label('enabled', 'Enabled ?',array('data-toggle'=>"tooltip", 'data-original-title'=>"Enabled ?")) }}
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