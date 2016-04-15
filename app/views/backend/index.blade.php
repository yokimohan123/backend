@extends('layouts.master')

@section('content')
    <?php 
    	$total_sale = $total_tax = $total_shipping = 0;         
     ?>
    @if(isset($orders))
    @foreach($orders as $order)
    	<?php $total_sale = $total_sale + $order['order_price_total'];  
    	 $total_tax = $total_tax + $order['tax_price_total']; 
    	 $total_shipping = $total_shipping + $order['shipping_price_total']; ?> 
    @endforeach
    @endif
    <div class="box-header" style="bottom: -10px;">
        <h3 class="box-title" style="margin-left: -11px;">Dashboard Summary</h3>
    </div>
    @if(isset($orders))
    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
        <thead>
            <tr role="row">
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Total Registered Users</th>
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Total Orders</th>
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Completed Orders</th>
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Pending Orders</th>
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Total Life Time Sale</th>
            </tr>
        </thead>
       	<tbody role="alert" aria-live="polite" aria-relevant="all">
	       	<tr>
	       		<td><a href="{{URL::to('/')}}/backend/usermanagement/show_user">{{count($registeredUser)}} Nos</a></td>
	       		<td><a href="{{URL::to('/')}}/backend/ordermanagment/orders">{{count($orders)}} Nos</a></td>
	       		<td>{{count($ordersCompleted),' Nos'}}</td>
	       		<?php $pendingOrder = count($orders) - count($ordersCompleted); ?>
	       		<td>{{$pendingOrder,' Nos'}}</td>
	       		<td>{{$total_sale}}</td>
	       	</tr>
       	</tbody>
    </table>
    @else
    	<p>No orders found</p>
    @endif

    <div class="box-header" style="bottom: -10px;">
        <h3 class="box-title" style="margin-left: -11px;">Last 5 Order</h3>
    </div>
    <div class="box-body table-responsive">
        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-6"></div>
        </div>
    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
        <thead>
            <tr>
            	<th>S.No</th>
               	<th>Customer</th>
                <th>Order No</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
        	@if(isset($last5Order))
        	<?php $sno =0; ?>
        	@foreach($last5Order as $lastorder)
        		<?php $sno = $sno + 1; ?>
            <tr>
            	<td>{{$sno}}</td>
            	<td>{{$lastorder['first_name']}} {{$lastorder['last_name']}}</td>
            	<td><a href="{{URL::to('/')}}/backend/ordermanagment/vieworder/{{$lastorder['id']}}">{{$lastorder['reference_no']}}</a></td>
            	<td>{{$lastorder['order_price_total']}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="box-header" style="bottom: -10px;">
        <h3 class="box-title" style="margin-left: -11px;">View by status</h3>
    </div>
    <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-6"></div>
    </div>
    <div class="row">
    	<div class="col-xs-12">
    		<div class="box">
                <div class="box-header">
                </div>
                	{{ Form::open(['route' => 'backend.dashboard.viewbystatus'])}}
                    <div class="box-body">      
                        <div class="form-group">
                            {{ Form::label('status', 'Select status',array('data-toggle'=>"tooltip", 'data-original-title'=>"status is required")) }}
                            @if(isset($orderstatus))
                            	{{ Form::select('status', $orderstatus) }}
                            @endif
                            {{ Form::button('View',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    @if(isset($ordersbystatus))
    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
        <thead>
            <tr role="row">
            	<th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">S.No</th>
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Order No</th>
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Name</th>
                <th class="sorting" role="columnheader" tabindex="0" rowspan="1" colspan="1">Shipping Price</th>
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
       		<?php $sno =0; ?>
            @foreach ($ordersbystatus as $bystatus)
            	<?php $sno = $sno + 1; ?>
              	<tr>
              		<td>{{$sno}}</td>
                	<td>{{$bystatus['reference_no']}}</td>
                    <td>{{$bystatus['first_name']}} {{$bystatus['last_name']}}</td>
                    <td>{{$bystatus['shipping_price_total']}}</td>
                    <td>{{$bystatus['discount_price']}}</td>
                    <td>{{$bystatus['tax_price_total']}}</td>
                    <td>{{$bystatus['order_price_total']}}</td>
                    <td>{{$bystatus['payment_type']}}</td>
                    <td>{{date('m/d/Y',$bystatus['order_date'])}}</td>
                    <td>{{$bystatus['order_status']}}</td>                                        
                    <td>{{$bystatus['invoice_no']}}</td>
                    <td class="">
                        <a href="{{URL::to('/')}}/backend/ordermanagment/vieworder/<?php echo $bystatus['id']; ?>">View</a>
                        | <a href="{{URL::to('/')}}/backend/ordermanagment/delete/<?php echo $bystatus['id']; ?>">Delete</a>                                            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>
@stop