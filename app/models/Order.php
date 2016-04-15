<?php

class Order extends \Eloquent {
	protected $fillable = ['user_id','reference_no','payment_type','invoice_no','invoice_date','discount_price','tax_price','shipping_price_total','order_price_total','order_date','shipping_date','delivery_date','order_status','address'];
	
}
