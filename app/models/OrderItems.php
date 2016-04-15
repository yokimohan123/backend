<?php

class OrderItems extends \Eloquent {

    protected $fillable = ['order_id', 'product_id', 'product_price', 'product_quantity'];

}
