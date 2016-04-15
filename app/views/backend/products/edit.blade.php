@extends('layouts.backend')
@section('content') 

<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_information" data-toggle="tab">Information</a></li>
                <li><a href="#tab_seo" data-toggle="tab">SEO</a></li>
                <li><a href="#tab_images" data-toggle="tab">Images</a></li>
                <li><a href="#tab_attachments" data-toggle="tab">Attachments</a></li>
                <li class="pull-right"><a href="<?php echo URL::to('/'); ?>/backend/products" class="text-muted"><i class="fa fa-chevron-left"></i>Go Back</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_information">
                    @include('backend.products.create.tab_information')
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_seo">
                    @include('backend.products.create.tab_seo')
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_images">
                    @include('backend.products.create.tab_image')
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_attachemnts">
                    @include('backend.products.create.tab_attachments') 
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>
@stop
