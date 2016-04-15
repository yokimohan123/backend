@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Management</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Id</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Name</th>                                
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1"Email</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Status</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Actions</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">

                            @foreach ($users as $user) 

                            <tr>
                                <td>{{$user['id']}}</td>
                                <td>{{$user['first_name']}}  {{$user['last_name']}}</td>            
                                <td>{{$user['email']}}</td>                                
                                <td> 
                                    <form action="{{URL::route('backend.usermanagement.user_status',$user['id'])}}" method ="post" enctype="multipart/form-data">

                                        <?php if ($user['activated']): ?>
                                            <input  name='enabled' class="btn btn-warning pull-left"  value='Disable' type='submit'>
                                        <?php else: ?>
                                            <input  name='enabled' class="btn btn-primary pull-left"  value='Enable' type='submit'>
                                        <?php endif; ?>
                                    </form>
                                </td>
                                <td class="">
                                <a href="{{URL::to('/')}}/backend/usermanagement/show_user/destroy_user/<?php echo $user['id']; ?>">Delete</a>                                            
                                </td>
                            </tr>                                 
                            @endforeach
                        </tbody>
                    </table>


                </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop