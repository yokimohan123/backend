<?php

class OrdersStatusHistory extends \Eloquent {
	protected $table = 'orders_status_history';
	protected $fillable = ['order_id','user_id','order_status_id','comment'];
}