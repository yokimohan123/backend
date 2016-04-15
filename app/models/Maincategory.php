
<?php

class Maincategory extends \Eloquent {
    
    protected $fillable = ['title','desc','quantit'];
    
    protected $table = 'maincategory';
        
    public static $rules = array(
        'title' => 'required',
        'desc' => 'required',
                
    );

    
	public function product()
	{
		return $this->hasMany('App\Model\Poduct');
	}
}