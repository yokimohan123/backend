@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_information" data-toggle="tab">Information</a></li>
                
                <li class="pull-right"><a href="<?php echo URL::to('/'); ?>/backend/users" class="text-muted"><i class="fa fa-chevron-left"></i> Go Back</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_information">
                    @include('backend.users.create.tab_information')
                </div><!-- /.tab-pane -->
               <!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->
</div>
@stop