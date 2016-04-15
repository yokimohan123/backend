@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Private Policy</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    {{ Form::open(['route' => 'backend.policy.update', 'method' => 'post']) }}
                        <div class="box-body">
                            <div class="form-group">
                                {{ Form::label('content', 'Description') }}
                                {{ Form::textarea('content',$policy->content, array('class' => 'form-control textarea','placeholder' => 'Enter Description')) }}
                            </div>
                        </div>
                        <div class="box-footer">
                            {{ Form::button('Submit',array('class'=>'btn btn-primary', 'type' => 'submit')) }}
                        </div>
                    {{Form::close()}}
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop