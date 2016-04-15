<?php 

class Category extends \Franzose\ClosureTable\Models\Entity implements categoriesInterface {

    protected $fillable = ['name','slug','description','enabled','meta_title','meta_description','meta_keyword'];
    
    public static $rules = array(
        'name' => 'required',
        'slug' => 'required|unique:categories,slug',
        'description' => 'required',
        'meta_title' =>'required',
        'meta_description' => 'required',
        'meta_keyword' => 'required',
    );
    
    public static function updaterules($id){
        return array_merge([
            'name' => 'required',
            'meta_title' =>'required',
            'meta_description' => 'required|unique:categories,meta_description',
            'meta_keyword' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id
        ]);
    }

    protected function replaceSlug($url) {
       $url = str_replace(array("\\",":","--","/"," ","?","#","*","<",">","@","&","$","(",")","!","~","'","’","#","%","^","[","]","{","}","'",'!',')','(','+','=','{','}','|','"\"',';',"'",'/','`','%','[',']',","), '-', $url);
        return $url;
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * ClosureTable model instance.
     *
     * @var categoriesClosure
     */
    protected $closure = '\categoriesClosure';

    public function products(){
        return $this->hasMany('Product');
    }
}