<?php
namespace Frontend;
use FrontOfficeController;
use View;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Redirect;
use Image;
use Input;
use Validator;
use Product;
use Cart;
use Response;
use ProductAttribute;
use Session;
use User;
use Address;
use Auth;
use Currency;
use URL;
use Start;
use Start_Charge;
use Config;
use AttributeValues;
use DB;
use Order;
use OrderItemAttributes;
use OrderItems;
use TransactionDetails;
use Hash;

class CartController extends FrontOfficeController {

	private $_api_context;

    public function __construct(){
    	parent::__construct();
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

	public function postAdd(){
		$data = Input::all();	
		// echo "<pre>";
		// print_r($data )	;
		// echo "</pre>";
		// exit;
		$products = Product::with('product_images')->where('id', '=', $data['product_id'])->get()->first();
		$products_sales = Product::with('product_images')->where('id', '=', $data['product_id'])->where('offer_price_yes','=',1)->get()->first();
		$size = '';
		$attributes = '';
		if(isset($data['size'])) {
			$size = $data['size'];
			$attribute_value = AttributeValues::where('value','=',$data['size'])->get()->first();
			$attributes[0]['attribute_value_id'] = $attribute_value->id;
			$attributes[0]['attribute_id'] = $attribute_value->attribute_id;
		}
		$color = '';
		if(isset($data['color'])) {
			foreach ($data['color'] as $key => $value) {			
					$color = $data['color'];
					$attribute_value = AttributeValues::where('color','=',$value)->get()->first();
					$attributes[1]['attribute_value_id'] = $attribute_value->id;
					$attributes[1]['attribute_id'] = $attribute_value->attribute_id;
				}
		}
		$pimage = '';
	   	if(count($products['product_images']) > 0) {
			$pimage = $products['product_images'][0]['image_path'];
	   	}	
	   	$price = '';
	   	if(isset($data['offer_price'])){
			$price = $products->offer_price;
	   	}else{
	   		$price = $products->original_price;
	   	}
		Cart::add(array('id' => $products->id,'qty' => $data['quantity'], 'options' => array('attributes'=>$attributes,'size'=>$size, 'color'=>$color,'image'=>$pimage), 'name' => $products->name, 'price' => $price));
		$cart_items = Cart::content()->toArray();
		$count = Cart::count();
		$cart_price = Cart::total();
		$data = '';
		if($count>0){
            foreach($cart_items as $items){
                $data .='<div class="cart_hover_top">
                    <img src="'.URL::to('/').'/uploads/products/original/'.$items['id'].'/'.$items['options']['image'].'" width="96px" height="97px">
                    <ul>
                        <li>'.$items['name'].'</li>
                        <li>QTY: '.$items['qty'].'</li>
                        <li>$'.$items['price'].'</li>
                    </ul>
                </div>';

            }
        }
        $data .='<div class="cart_hover_bottom">
            <a href="'.URL::to('/').'/cart/view" id="cart_view">
                <input type="button" name="cart_hover_submit" value="VIEW BAG">
            </a>
        </div>';
		$response = array('status'=>'success','count'=>$count,'cart_price'=>$cart_price,'data'=>$data);
		return Response::json($response);
	}
	public function postSetcurrency(){
		$data = Input::all();
		Session::set('currency',$data['currency']);
		return Response::json('success');
	}

	public function getView(){
		
		$cart_items = Cart::content()->toArray();
		$cart_count = Cart::count(false);
		if (Auth::check()){
			$address = Address::where('user_id','=',Auth::user()->id)->get()->first();
		}else{
			if(Session::has('user')){
				$user = Session::get('user');
				$address = Address::where('user_id','=',$user->id)->get()->first();
			}
		}
		return View::make('frontend.checkout.shopping_cart',compact('cart_items','address','user'));
	}

	public function getShipping(){
		$cart_items = Cart::content()->toArray();
		$cart_count = Cart::count(false);
		if (Auth::check()){
			$address = Address::where('user_id','=',Auth::user()->id)->get()->first();
		}else{
			if(Session::has('user')){
				$user = Session::get('user');
				$address = Address::where('user_id','=',$user->id)->get()->first();
			}
		}
		return View::make('frontend.checkout.shipping',compact('cart_items','address','user'));
	}

	public function getPayment(){
		$cart_items = Cart::content()->toArray();
		$cart_count = Cart::count(false);
		if (Auth::check()){
			$address = Address::where('user_id','=',Auth::user()->id)->get()->first();
		}else{
			if(Session::has('user')){
				$user = Session::get('user');
				$address = Address::where('user_id','=',$user->id)->get()->first();
			}
		}
		return View::make('frontend.checkout.payment',compact('cart_items','address','user'));
	}

	public function getConfirm(){
		$cart_items = Cart::content()->toArray();
		$payment_detail = Session::get('payment_detail');
		if (Auth::check()){
			$address = Address::where('user_id','=',Auth::user()->id)->get()->first();
		}else{
			if(Session::has('user')){
				$user = Session::get('user');
				$address = Address::where('user_id','=',$user->id)->get()->first();
			}
		}
		return View::make('frontend.checkout.confirmation',compact('address','cart_items','user','payment_detail'));
	}

	public function getDelete(){
		$data = Input::all();
		Cart::remove($data['rowid']);
		Session::flash('item_deleted','Item removed successfully from shopping bag!');
		return Redirect::to('cart/'.$data['back']);
	}

	public function postPaymentdetail(){
		$data = Input::all();
		Session::set('payment_detail',$data);
		return Redirect::to(URL::to('/')."/cart/confirm");
	}

	public function postPayment(){
		$data = Session::get('payment_detail');
		if($data['payment'] =="credit_cadrd"){
			$this->anyCardTransaction($data);
		}elseif($data['payment'] =="paypal"){
			$this->anyPaypalTransaction();
		}elseif($data['payment'] =="cash_delivery"){
			$this->anyCODTransaction();
		}
	}

	public function anyCardTransaction($data){
		$cart_items = Cart::content()->toArray();
		$cart_count = Cart::count(false);
		$order = $this->anyOrder($type="Card");
		Session::set('reference_no',$order->reference_no);
		if (Auth::check()){
			$email = Auth::user()->email;
		}else{
			if(Session::has('user')){
				$user = Session::get('user');
				$email = $user->email;
			}
		}
		Start::setApiKey("test_sec_k_09ace3fa19fff54558326");
		$charge = Start_Charge::create(array(
		  "amount" => Cart::total(),
		  "currency" => Session::get('currency'),
		  "card" => array(
		    "name" => $data['cr_name'],
		    "number" => $data['cr_no1'].$data['cr_no2'].$data['cr_no3'].$data['cr_no4'],
		    "exp_month" => $data['expir_month'],
		    "exp_year" => $data['expir_year'],
		    "cvc" => $data['csc']
		  ),
		  "description" => "For product purchased from dimaayad",
		  "email" => $email
		));
		$transaction_details = new TransactionDetails();
		$transaction_details->order_id = $order->reference_no;
	    $transaction_details->transaction_id = $charge['id'];
	    $transaction_details->amount = $charge['amount'];
	    $transaction_details->currency = $charge['currency'];
	    $transaction_details->date = $charge['created_at'];
	    $transaction_details->payment_status = $charge['state'];	
	    $transaction_details->save();
		if($charge['state']=="captured"){
			$order = Order::where('reference_no','=',$order->reference_no)->first();
		    $order->payment_status = "completed";
			$order->save();
		}
		return Redirect::to(URL::to('/')."/cart/success")->send();
	}

	public function anyPaypalTransaction(){
		$cart_items = Cart::content()->toArray();
		$cart_count = Cart::count(false);
		$order = $this->anyOrder($type="Paypal");
		Session::set('reference_no',$order->reference_no);
		$payer = new Payer();
	    $payer->setPaymentMethod('paypal');
	    $amount = new Amount();
	    $amount->setCurrency(Session::get('currency'))
	        ->setTotal(1);
	    $transaction = new Transaction();
	    $transaction->setAmount($amount)
	        //->setItemList($item_list)
	        ->setDescription('Your Total'.' : '.  number_format(1,2).' '.Session::get('currency'));

	    $redirect_urls = new RedirectUrls();
	    $redirect_urls->setReturnUrl(URL::to('/')."/cart/paymentstatus")
	        ->setCancelUrl(URL::to('/')."/cart/paymentstatus");
	    $payment = new Payment();
	    $payment->setIntent('Sale')
	        ->setPayer($payer)
	        ->setRedirectUrls($redirect_urls)
	        ->setTransactions(array($transaction));

	    try {
	        $payment->create($this->_api_context);
	    } catch (\PayPal\Exception\PPConnectionException $ex) {
	        if (\Config::get('app.debug')) {
	            echo "Exception: " . $ex->getMessage() . PHP_EOL;
	            $err_data = json_decode($ex->getData(), true);
	            exit;
	        } else {
	            die('Some error occur, sorry for inconvenient');
	        }
	    }

	    foreach($payment->getLinks() as $link) {
	        if($link->getRel() == 'approval_url') {
	            $redirect_url = $link->getHref();
	            break;
	        }
	    }

	    // add payment ID to session
	    Session::put('paypal_payment_id', $payment->getId());

	    if(isset($redirect_url)) {
	        // redirect to paypal
	        return Redirect::to($redirect_url)->send();
	    }
	    return Redirect::route('original.route')->with('error', 'Unknown error occurred');
	}

	public function getPaymentstatus(){
	    // Get the payment ID before session clear
	    $payment_id = Session::get('paypal_payment_id');
	    Session::forget('paypal_payment_id');

	    // if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
	    //     return Redirect::route('original.route')->with('error', 'Payment failed');
	    // }

	    $payment = Payment::get($payment_id, $this->_api_context);

	    $execution = new PaymentExecution();
	    $execution->setPayerId(Input::get('PayerID'));

	    //Execute the payment
	    $result = $payment->execute($execution, $this->_api_context);
	    //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
	    $reference_no = Session::get('reference_no');
	    $transaction_details = new TransactionDetails();
	    $transaction_id = $result->transactions[0]->related_resources[0]->sale->id;
	    $transaction_time = $result->transactions[0]->related_resources[0]->sale->create_time;
	    $transaction_amount = $result->transactions[0]->related_resources[0]->sale->amount->total;
	    $transaction_currency = $result->transactions[0]->related_resources[0]->sale->amount->currency;
	    $transaction_status = $result->transactions[0]->related_resources[0]->sale->state;
	    
	    $transaction_details->order_id = $reference_no;
	    $transaction_details->transaction_id = $transaction_id;
	    $transaction_details->amount = $transaction_amount;
	    $transaction_details->currency = $transaction_currency;
	    $transaction_details->date = $transaction_time;
	    $transaction_details->payment_status = $transaction_status;	
	    $transaction_details->save();

	    if ($result->getState() == 'approved') { // payment made
	    	$order = Order::where('reference_no','=',$reference_no)->first();
		    $order->payment_status = $transaction_status;
			$order->save();
	    	Session::set('transaction_details',$transaction_details->transaction_id);
	    	return Redirect::to(URL::to('/')."/cart/success");
	    }
	    
	    return Redirect::to(URL::to('/')."/cart/failed");
	}

	public function anyCODTransaction(){
		$order = $this->anyOrder($type="COD");
		return Redirect::to(URL::to('/')."/cart/success")->send();
	}

	public function anyOrder($type){
		$cart_items = Cart::content()->toArray();
		$user = Session::get('user');
		$address = Session::get('shipping_address');
		$prefix = "DMYD";
		$prefix_no = 00000;
		$tmp_id = DB::table('orders')->max('id');
		$no = sprintf("%05d",$prefix_no + $tmp_id + 1);
		$reference_no = $prefix.$no;
		$order = new Order;
		$order->reference_no = $reference_no;
		$order->user_id = $user['id'];
		$order->order_price_total = Cart::total();
		$order->discount_price = 0;
		$order->tax_price_total = 0;
		$order->shipping_price_total = 0;
		$order->order_date = time();
		$order->order_status = 'New';
		$order->payment_type = $type;
		$order->currency = Session::get('currency');
		$order->address = $address->id;
		$order->save();
		foreach($cart_items as $items){
			$orderItems = new OrderItems;
			$orderItems->order_id =$order->id;
			$orderItems->product_id = $items['id'];
			$orderItems->product_price = $items['price'];
			$orderItems->product_quantity = $items['qty'];
			$orderItems->save();

			if(isset($items['options']['attributes']) && $items['options']['attributes'] != ''){
				foreach ($items['options']['attributes'] as $key => $value) {
					$orderItemAttribute = new OrderItemAttributes;
					$orderItemAttribute->order_id = $order->id;
					$orderItemAttribute->product_id = $items['id'];
					$orderItemAttribute->attribute_value_id = $value['attribute_value_id'];
					$orderItemAttribute->attribute_id = $value['attribute_id'];
					$orderItemAttribute->save();
				}
			}
		}
		Session::set('order_details',$order);
		return $order;
	}

	public function getSuccess(){
		Cart::destroy();
		$order_details = Session::get('order_details');
		return View::make('frontend.checkout.success',compact('order_details'));
	}

	public function postShipping(){
		$data = Input::all();
		if(!Input::has('option')){
			return Response::json('select_shipping');
		}
		if($data['option']=="change_address"){
			if(Input::has('name') && Input::has('email')){
				$user = User::where('email','=',$data['email'])->get()->first();
				if(count($user)==0){
					$user = new User;
					$user->email = $data['email'];
					$user->username = $data['email'];
					$user->activated = 1;
					$user->first_name = $data['name'];
					$user->group_id = 3;
					$user->save();
					$address = new Address;
					$address->user_id = $user->id;
					$address->billing_address = $data['address'];
					$address->billing_city = $data['town'];
					$address->billing_zipcode = $data['country'];
					$address->billing_country = $data['zip'];
					$address->shipping_address = $data['address'];
					$address->shipping_city = $data['town'];
					$address->shipping_zipcode = $data['country'];
					$address->shipping_country = $data['zip'];
					$address->save();
					Session::put('shipping_address',$address);
					Session::put('user',$user);
					return Response::json('success');
				}else{
					if (Auth::check()){
						$address = Address::where('user_id','=',$user->id)->get()->first();
						$address->billing_address = $data['address'];
						$address->billing_city = $data['town'];
						$address->billing_zipcode = $data['country'];
						$address->billing_country = $data['zip'];
						$address->shipping_address = $data['address'];
						$address->shipping_city = $data['town'];
						$address->shipping_zipcode = $data['country'];
						$address->shipping_country = $data['zip'];
						$address->save();
						Session::put('shipping_address',$address);
						return Response::json('success');
					}else{
						return Response::json('email_exist');
					}
					return Response::json('email_exist');
				}
			}else{
				return Response::json('invalid');
			}
		}else{
			if (Auth::check()){
				return Response::json('success');
			}else{
				return Response::json('plz_login');
			}
		}
	}
}