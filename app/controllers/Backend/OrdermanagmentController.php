<?php

namespace Backend;

use AdminAuthController;
use View;
use Order;
use OrderItems;
use OrderItemAttributes;
use OrdersStatus;
use OrdersStatusHistory;
use Input;
use Redirect;
use Address;
use DB;
use URL;
use Register;
use Mail;
use Block;
use ProductImage;
use TransactionDetails;
use PaymentBank;
use Validator;
use PaymentPaypal;
use OrderStatusBank;
use User;
use AttributeValues;
use PaymentInfo;

class OrdermanagmentController extends AdminAuthController {

	public function order(){
		$order = Order::join('users','orders.user_id','=','users.id')
                        ->orderBy('orders.id', 'DESC')
                        ->get(array('reference_no','shipping_price_total','discount_price','tax_price_total','order_price_total','payment_type','order_date','order_status','address','payment_status','shipping_date','invoice_no','invoice_date','orders.id','users.first_name','users.last_name','users.id as user_id'))->toArray();
        
		return View::make('backend.ordermanagment.orderlist', compact('order'));
	}

    public function viewOrder($id){
        $order = Order::join('users','orders.user_id','=','users.id')->where('orders.id','=',$id)->orderBy('orders.id', 'DESC')->get(array('reference_no','shipping_price_total','discount_price','tax_price_total','order_price_total','payment_type','order_date','order_status','invoice_no','invoice_date','orders.id','users.first_name','users.last_name','users.email','users.id as user_id'))->toArray();

        $adress = DB::table('orders')
            ->join('address', 'address.user_id', '=', 'orders.user_id')
            ->where('orders.id','=',$id)->get();
            
        $orderproduct = OrderItems::join('products','order_items.product_id','=','products.id')->where('order_id','=',$id)->get(array('order_items.id','order_items.order_id','order_items.product_id','order_items.product_price','order_items.product_quantity','products.name'))->toArray();
        foreach ($orderproduct as $value) {
            $attributes[] = AttributeValues::join('order_item_attributes','attribute_values.id','=','order_item_attributes.attribute_value_id')
                                            ->join('attributes','attribute_values.attribute_id','=','attributes.id')
                                            ->where('order_item_attributes.product_id','=',$value['product_id'])
                                            ->where('order_item_attributes.order_id','=',$value['order_id'])
                                            ->get(array('attributes.name','attributes.attribute_type','attribute_values.value','order_item_attributes.order_id','order_item_attributes.product_id'))->toArray();
            $productImages[] = OrderItems::join('product_images','order_items.product_id','=','product_images.product_id')->where('product_images.product_id','=',$value['product_id'])->where('order_items.id','=',$value['id'])->take(1)->get(array('product_images.product_id', 'product_images.image_path','order_items.id'))->toArray();
        }
        $orderstatus = OrdersStatus::lists('status','id');
        $orderhistory = OrdersStatusHistory::join('orders_status','orders_status_history.order_status_id','=','orders_status.id')->where('orders_status_history.order_id','=',$id)->get()->toArray();
        $transaction = TransactionDetails::where('order_id','=',$order[0]['reference_no'])->get()->toArray();
        return View::make('backend.ordermanagment.vieworder',compact('bank_details','paypal_details','orderproduct','productImages','order','attributes','orderstatus','orderhistory','adress','transaction'));
    } 
    public function changeStatus(){
        $orderstatushistory = new OrdersStatusHistory();
        $data = Input::all();
        $orderstatushistory->order_id = $data['order_id'];
        $orderstatushistory->user_id = $data['user_id'];
        $orderstatushistory->order_status_id = $data['status'];
        $orderstatushistory->comment = $data['comment'];
        if(isset($data['notification'])){
            $orderstatushistory->status_notification = $data['notification'];
        }else{
            $orderstatushistory->status_notification = 0;
        }
        $orderstatushistory->updated_on = time();
        $orderstatushistory->save();

        $status = OrdersStatus::where('id','=',$data['status'])->first();

        $order = Order::where('id','=',$data['order_id'])->first();
        $order->order_status = $status->status;
        $order->save();

        if($orderstatushistory->status_notification == 1){
            $user = User::where('id','=',$data['user_id'])->get()->toArray();
            $datas = array(
                'first_name' => $user[0]['first_name'],
                'email' => $user[0]['email']
            );
            $input = array(
            'first_name' => $user[0]['first_name'],
            'comment' => $data['comment'],
            'status' => $data['status']
            );

            Mail::send('emails.admin.order.statusupdate', $input, function($message) use ($datas){
                $block = Block::all();
                $block = Block::where('slug', 'LIKE', '%general_admin_email%')->get($block[0]['link']);
                //email 'To' field: change this to emails that you want to be notified.
                $message->from($block[0]['link'])
                        ->to($datas['email'], $datas['first_name'])
                        ->cc($block[0]['link'])
                        ->replyTo($block[0]['link'])
                        ->subject('Status for your product');
            });
        }
        if($data['stay'] == 1){
            return Redirect::back();
        }else{
            return Redirect::route('backend.ordermanagment.orders');
        }
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return Redirect::back();
    }    
}
