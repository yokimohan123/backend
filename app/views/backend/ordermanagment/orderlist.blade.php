@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Order Management</h3>
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
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Order No</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Name</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Discount</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Tax</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Total Price</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Payment</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Order Date</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Status</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Invoice No</th>
                                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Actions</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">

                            @foreach ($order as $orders) 

                            <tr>
                                <td>{{$orders['reference_no']}}</td>
                                <td>{{$orders['first_name']}} {{$orders['last_name']}}</td>
                                <td>{{$orders['discount_price']}}</td>
                                <td>{{$orders['tax_price_total']}}</td>
                                <td>{{$orders['order_price_total']}}</td>
                                <td>{{$orders['payment_type']}}</td>
                                <td>{{date('m/d/Y',$orders['order_date'])}}</td>
                                <td>{{$orders['order_status']}}</td>                                        
                                <td>{{$orders['invoice_no']}}</td>
                                <td class="">
                                    <a href="{{URL::to('/')}}/backend/ordermanagment/vieworder/<?php echo $orders['id']; ?>">View</a>
                                    | <a href="{{URL::to('/')}}/backend/ordermanagment/delete/<?php echo $orders['id']; ?>">Delete</a>                                            
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