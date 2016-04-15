<?php

class Product extends \Eloquent {

    // Don't forget to fill this array
    
    protected $fillable = ['name', 'slug', 'reference', 'offer_price','offer_price_yes', 'quantity', 'short_description', 'description', 'enabled', 'out-of-stock', 'view_count', 'child_category_id', 'parent_category_id', 'category_id','meta_title','meta_description','meta_keyword', 'installation_charges','original_price','new_tag','sale_tag'];

    // Add your validation rules here

    public static $rules = array(
        'name' => 'required',
        'slug' => 'required|unique:products,slug',
        'reference'=>'required',
        'offer_price'=>'required',
        'quantity'=>'required',
        'short_description'=>'required',
        'description'=>'required',
        'original_price' => 'required',
        'category_id' => 'required'

        



    );
    public static $category_rules = array(
        'name' => 'required',
        'slug' => 'required|unique:products,slug',
        'reference'=>'required',
        'offer_price'=>'required',
        'quantity'=>'required',
        'short_description'=>'required',
        'description'=>'required',
        'original_price' => 'required',
        'category_id' => 'required',
        'child_category_id' => 'required'
    );
    
    public static $seorules = array(
        'meta_title'=>'required|unique:products,meta_title',
        'meta_description'=>'required|unique:products,meta_description',
        'meta_keyword'=>'required|unique:products,meta_keyword'

    );

    public static $positionrules = array(
        'position_id'=>'required'
        

    );
    public static function updaterules($id){
        return array_merge([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$id
        ]);
    }

    protected function replaceSlug($url) { 
        $url = str_replace(array("\\",":","--","/"," ","?","#","*","<",">","@","&","$","(",")","!","~","'","’","#","%","^","[","]","{","}","'",'!',')','(','+','=','{','}','|','"\"',';',"'",'/','`','%','[',']',","), '-', $url);
        return $url;
    }

    protected $table = 'products';

    public function category() {
        return $this->belongsTo('Category');
    }

    public function product_images() {
        return $this->hasMany('ProductImage')->orderBy('position_id');
    }
    
    public function category_product_images() {
        return $this->hasOne('ProductImage');
    }

    public function order_product_images(){
        return $this->hasOne('ProductImage');
    }

    // public function product_line_drawings() {
    //     return $this->hasMany('ProductLineDrawing')->orderBy('position_id');
    // }

    public function product_attachments() {
        return $this->hasMany('ProductAttachment')->orderBy('position_id');
    }

    public function product_attributes() {
        return $this->hasMany('ProductAttribute');
    }
    public function product_attribute_prices() {
        return $this->hasMany('ProductAttributePrice');
    }
    public function wishlist() {
        return $this->belongsToMany('Wishlist');
    }
    public function orders_product() {
        return $this->hasMany('OrdersProduct'); 
    }
}
