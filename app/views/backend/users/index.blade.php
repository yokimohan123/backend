@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Profile</h3>               
                <div class="box-tools pull-right">                  
                    <!-- <li class="pull-right"><a href="{{URL::route('backend.users.create')}}" class="text-muted btn btn-default btn-sm"><i class="fa fa-plus"></i> Create new User</a></li> -->
                </div>
            </div><!-- /.box-header -->
            @if (Session::has('message'))
                   <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif   
            <div class="box-body table-responsive">                     
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">                                
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Firstname</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="40%">Lastname</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="40%">Email</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Username</th>                               
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1" width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                          <?php  { ?>
                                <tr>                                    
                                    <td>{{$user['first_name']}}</td>
                                    <td>{{$user['last_name']}}</td>
                                    <td>{{$user['email']}}</td>
                                    <td>{{$user['username']}}</td>                                                                      
                                    <td class="">
                                        <a href="{{URL::to('/')}}/backend/users/edit/<?php echo $user['id']; ?>">Edit</a>  
                                       
                                    </td>
                                </tr>
                            <?php } ?>                               
                        </tbody>
                    </table>
                </div>                
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop