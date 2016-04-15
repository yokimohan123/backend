<?php

class TransactionDetails extends \Eloquent {
	protected $fillable = ['id','order_id','transaction_id','amount','currency','date','payment_status'];
}