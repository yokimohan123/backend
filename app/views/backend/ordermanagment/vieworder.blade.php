@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Order Overview</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid" >
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <?php if (count($order) >0 ) { ?>                           
                               @foreach ($order as $orders)
                                    <tr>                                
                                        <th>Name</th>
                                        <td>{{$orders['first_name']}} {{$orders['last_name']}}</td>
                                        <th>Email</th>
                                        <td>{{$orders['email']}}</td>
                                        <th>Order No</th>
                                        <td>{{$orders['reference_no']}}</td>
                                    </tr>
                                    @foreach ($adress as $addr)
                                    <tr>
                                        <th>Shipping Address</th>
                                        <td colspan="2">
                                            {{$addr->shipping_address}}<br>
                                            {{$addr->shipping_city}}<br>
                                            {{$addr->shipping_state}}<br>
                                            {{$addr->shipping_country}}<br>
                                            {{$addr->shipping_zipcode}}<br>
                                        </td> 
                                       <th>Billing Address</th>
                                       <td colspan="2">
                                           {{$addr->billing_address}}<br>
                                           {{$addr->billing_city}}<br>
                                           {{$addr->billing_state}}<br>
                                           {{$addr->billing_country}}<br>
                                           {{$addr->billing_zipcode}}<br>
                                       </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                    <th>Payment Type</th>
                                        <td>{{$orders['payment_type']}}</td>
                                    <th>Order Date</th>
                                        <td>{{date('m/d/Y H:i:s',$orders['order_date'])}}</td>
                                   <!--  <th>Discount</th>
                                        <td>{{Config::get('constants.Currency_Symbol').$orders['discount_price']}}</td> -->
                                    </tr>
                                    <tr>
                                    <!-- <th>VAT</th>
                                        <td>{{Config::get('constants.Currency_Symbol').$orders['tax_price_total']}}</td> -->                                    
									<th>Current Status</th>
                                       <td>{{$orders['order_status']}}</td>
                                    <th>Total</th>
                                        <td>{{Config::get('constants.Currency_Symbol').$orders['order_price_total'] }}</td>
                                   
									</tr>
                                @endforeach
                                <?php } ?>
                            </thead>                                              
                    </table>

                    <div class="box-header" style="bottom: -10px;">
                        <h3 class="box-title" style="margin-left: -11px;">Transaction Details</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-6"></div>
                        </div>
                        <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>Currency</th>
                                <th>Payment Status</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($transaction as $transactionDetails)
                                <td>{{$transactionDetails['order_id']}}</td>
                                <td>{{$transactionDetails['transaction_id']}}</td>
                                <td>{{$transactionDetails['amount']}}</td>
                                <td>{{$transactionDetails['currency']}}</td>
                                <td>{{$transactionDetails['payment_status']}}</td>
                                <td>{{$transactionDetails['date']}}</td>
                            @endforeach
                        </tr>
                        </tbody>
                        </table>
                     <div class="box-header" style="bottom: -10px;">
                        <h3 class="box-title" style="margin-left: -11px;">Ordered Products</h3>
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
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Attribute</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sno =0; ?>
                            @foreach($orderproduct as $product)
                            <?php $sno = $sno +1;?>
                            <tr class="editblocks">
                                <td><p class="showpageblock">{{$sno}}</p></td>
                                <td style="cursor:pointer"><p class="showpageblock">{{$product['name']}}</p></td>
                                <td>
                                    <p class="showpageblock">
                                    @foreach($productImages as $images)
                                        @foreach($images as $image)
                                            @if($product['id'] == $image['id'])
                                                <img src="{{URL::to('/')}}/uploads/products/small/{{$image['product_id']}}/{{$image['image_path']}}">
                                            @endif
                                        @endforeach
                                    @endforeach
                                    </p>
                                </td>
                                <td style="cursor:pointer">
                                    <p class="showpageblock">
                                    @foreach($attributes as $attribute)
                                        @foreach($attribute as $att)
                                            <p><b>{{$att['name']}} : </b>{{$att['value']}}</p>
                                        @endforeach
                                    @endforeach
                                    </p>
                                </td>
                                <td style="cursor:pointer"><p class="showpageblock">{{$product['product_quantity']}}</p></td>
                                <td style="cursor:pointer"><p class="showpageblock">{{Config::get('constants.Currency_Symbol').$product['product_price']}}</p></td>
                                <td style="cursor:pointer"><p class="showpageblock">{{Config::get('constants.Currency_Symbol').number_format($product['product_quantity'] * $product['product_price'],2)}}</p></td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table> 
                        @foreach ($order as $orders)
                            <table id="example2" class="table table-bordered table-hover dataTable sub-total" aria-describedby="example2_info">
                                <!-- <tr>
                                    <th>VAT</th><td>{{Config::get('constants.Currency_Symbol').number_format($orders['tax_price_total'], 2)}}</td>
                                </tr> -->
                                <!-- <tr>
                                    <th>Discount</th><td>{{Config::get('constants.Currency_Symbol').number_format($orders['discount_price'], 2)}}</td>
                                </tr> -->
                                <tr>
                                    <th>Total</th><td>{{Config::get('constants.Currency_Symbol').number_format($orders['order_price_total'],2)}}</td>
                                </tr>
                            </table>
                        @endforeach 
                </div>
                <div class="box-header col-xs-12" style="bottom: -10px;">
                        <h3 class="box-title" style="margin-left: -11px;">Status History</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-6"></div>
                        </div>
                        <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th>Status Updated On</th>
                                <th>Status</th>
                                <th>Comment</th>
                                <th>Notification</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $orders)
                            <tr>
                                <td>{{date('m/d/Y H:i:s',$orders['order_date'])}}</td>
                                <td>{{$orders['order_status']}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endforeach
                            @foreach ($orderhistory as $history)
                            <tr>
                                <td>{{date('m/d/Y H:i:s',$history['updated_on'])}}</td>
                                <td>{{$history['status']}}</td>
                                <td>{{$history['comment']}}</td>
                                <td>@if($history['status_notification'] == 1){{'Yes'}} @else {{'No'}} @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                 
                        <div class="box-header" style="bottom: -10px;">
                            <h3 class="box-title" style="margin-left: -11px;">Add Status</h3>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                    </div>
                                    {{ Form::open(['route' => 'backend.orderstatus.change'])}}
                                    <div class="box-body"> 
                                        {{ Form::hidden('order_id', $orders['id'], null); }}
                                        {{ Form::hidden('user_id', $orders['user_id'], null); }}
                                        <fieldset>
                                            <div class="form-group">
                                                {{ Form::label('status', 'Status*') }}<br>
                                                {{ Form::select('status', $orderstatus,null,array('class'=>"form-control",'id'=>"exampleInputTitle1")) }}
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-group">
                                                {{ Form::label('comment', 'Comment',array('data-tommentoggle'=>"tooltip", 'data-original-title'=>"Comment is required")) }}
                                                {{ Form::textarea('comment',null, array('class' => 'form-control','placeholder' => 'Comment','size' => '30x5')) }}
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-group">
                                                {{ Form::label('notification', 'Notification',array('data-toggle'=>"tooltip", 'data-original-title'=>"Notification is required")) }}
                                                {{ Form::checkbox('notification', 1, false); }}
                                            </div>
                                        </fieldset>
                                        <div class="box-footer">
                                            {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
                                            {{ Form::button('Save & Stay',array('class'=>'btn btn-primary','value' => '1', 'name' => 'stay', 'type' => 'submit')) }}
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>

                        @if($orders['payment_type'] == 'Bank')
                        <div class="box-header" style="bottom: -10px;">
                            <h3 class="box-title" style="margin-left: -11px;">Add Bank Status</h3>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                    </div>
                                    {{ Form::open(['route' => 'backend.bank_transfer.status_change'])}}
                                    <div class="box-body">      
                                        {{ Form::hidden('order_id', $orders['id'], null); }}
                                        {{ Form::hidden('user_id', $orders['user_id'], null); }}
                                        
                                         <div class="form-group">
                                            {{ Form::label('comment', 'Comment',array('data-tommentoggle'=>"tooltip", 'data-original-title'=>"Comment is required")) }}
                                            {{ Form::textarea('comment',null, array('class' => 'form-control','placeholder' => 'Comment')) }}
                                        </div><br>

                                        <div class="form-group">
                                            {{ Form::label('status', 'Status',array('data-tommentoggle'=>"tooltip", 'data-original-title'=>"Status is required")) }}
                                            {{ Form::text('status',null, array('class' => 'form-control','placeholder' => 'Status')) }}
                                        </div><br>

                                        <div class="box-footer">
                                            {{ Form::button('Submit',array('class'=>'btn btn-primary','value' => '0', 'name' => 'stay', 'type' => 'submit')) }}
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    @endif
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop