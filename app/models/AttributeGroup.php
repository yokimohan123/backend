<?php

class AttributeGroup extends \Eloquent {

    protected $fillable = ['id','group_name'];
    public static $rules = array(
        'id' => 'required',
        'group_name' => 'required'
    );
	
	
	public function attribute(){
        return $this->hasMany('Attribute');
    }
}
