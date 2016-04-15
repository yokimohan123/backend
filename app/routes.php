<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Frontend
Route::get('/', array('as' => 'root', 'uses' => 'Frontend\HomeController@index'));

//Collection
Route::get('/frontend/collection', array('as' => 'collection', 'uses' => 'Frontend\CollectionController@collection'));

//Designer
Route::get('/designer', array('as' => 'design', 'uses' => 'Frontend\DesignerController@designer'));

//Shop
// Route::get('/shops', array('as' => 'shop', 'uses' => 'Frontend\HomePageController@breadcrum'));

Route::get('/shop', array('as' => 'categories.shop', 'uses' => 'Frontend\ShopController@shop'));
Route::get('/shop/{slug}', array('as' => 'shop', 'uses' => 'Frontend\ShopController@products'));
Route::get('/shop/product_details/{id}', array('as' => 'shop.productdetails', 'uses' => 'Frontend\ShopController@product_details'));

//Sales

Route::get('/sales', array('as' => 'categories.sales', 'uses' => 'Frontend\ShopController@sales'));
Route::get('/sales/{slug}', array('as' => 'sales', 'uses' => 'Frontend\ShopController@salesProducts'));
Route::get('/sales/product_details/{id}', array('as' => 'sales.productdetails', 'uses' => 'Frontend\ShopController@sales_product_details'));

//Press
Route::get('/frontend/press', array('as' => 'frontend.press', 'uses' => 'Frontend\HomeController@press'));

//Footer
Route::get('/contactus', array('as' => 'contactus', 'uses' => 'Frontend\HomeController@contactus'));
Route::post('contactus', array('as' => 'frontend.contactus', 'uses' => 'Frontend\HomeController@postcontactus'));

// Private Policy
Route::get('private-policy', array('as' => 'frontend.policy', 'uses' => 'Frontend\HomeController@Privatepolicy'));
Route::get('backend/private-policy', array('as' => 'backend.policy', 'uses' => 'Backend\HomepageController@Privatepolicy'));
Route::get('backend/private-policy/edit', array('as' => 'backend.policy.edit', 'uses' => 'Backend\HomepageController@PrivatepolicyEdit'));
Route::post('backend/private-policy/edit', array('as' => 'backend.policy.update', 'uses' => 'Backend\HomepageController@PrivatepolicyUpdate'));

//Terms and Condition
Route::get('terms-and-condition', array('as' => 'frontend.terms.terms-and-condition', 'uses' => 'Frontend\HomeController@termsAndCondition'));
Route::get('backend/terms-and-condition', array('as' => 'backend.terms-and-condition', 'uses' => 'Backend\SettingsController@termsAndCondition'));
Route::get('backend/terms-and-condition/edit', array('as' => 'backend.terms-and-condition.edit', 'uses' => 'Backend\SettingsController@editTermsAndCondition'));
Route::post('backend/terms-and-condition/edit', array('as' => 'backend.terms-and-condition.update', 'uses' => 'Backend\SettingsController@updateTermsAndCondition'));


// Auth - Backend login
Route::get('backend', array('as' => 'backend', 'uses' => 'Backend\AuthController@backend')); //1
Route::get('backend/dashboard', array('as' => 'backend.dashboard', 'uses' => 'Backend\HomepageController@dashboard'));
Route::post('backend/dashboard', array('as' => 'backend.dashboard.viewbystatus', 'uses' => 'Backend\HomepageController@dashboard'));
Route::post('backend/login', array('as' => 'backend.login', 'uses' => 'Backend\AuthController@postLogin'));
Route::get('backend/logout', array('as' => 'backend.logout', 'uses' => 'Backend\AuthController@logout'));

Route::get('backend/password/remind', array('as' => 'password.remind','uses' => 'Backend\AuthController@remind'));
Route::post('backend/password/request', array('as' => 'password.request','uses' => 'Backend\AuthController@request'));
Route::get('backend/password/reset/{code}', array('as' => 'password.reset','uses' => 'Backend\AuthController@reset'));
Route::post('backend/password/update', array('as' => 'password.update','uses' => 'Backend\AuthController@update'));
Route::get('backend/password/change',array('as'=>'password.change','uses'=>'Backend\AuthController@change'));
Route::post('backend/password/edit',array('as'=>'password.edit','uses'=>'Backend\AuthController@PasswordChange'));

Route::get('backend/ordermanagment/orders',['as' => 'backend.ordermanagment.orders', 'uses' => 'Backend\OrdermanagmentController@order']);
Route::get('backend/ordermanagment/delete/{id}',['as' => 'backend.ordermanagment.delete', 'uses' => 'Backend\OrdermanagmentController@destroy']);
Route::get('backend/ordermanagment/vieworder/{id}',['as' => 'backend.ordermanagment.vieworder', 'uses' => 'Backend\OrdermanagmentController@viewOrder']);
Route::post('backend/ordermanagment/status', array('as' => 'backend.orderstatus.change', 'uses' => 'Backend\OrdermanagmentController@changeStatus'));
Route::post('backend/ordermanagment/bank_transfer', array('as' => 'backend.bank_transfer.status_change', 'uses' => 'Backend\OrdermanagmentController@changeOrderBankStatus'));


# Authentication 
Route::get('login',array('as'=>'frontend.index','uses'=>'Frontend\AuthController@index'));
# Register
Route::get('/register',['as' => 'frontend.register','uses' => 'Frontend\AuthController@getRegister']);


Route::post('/auth/register',['as' => 'frontend.auth.register','uses' => 'Frontend\AuthController@store']);
# Mail activation
Route::get('/user/login/{code}',['as' => 'activate','uses' => 'Frontend\AuthController@profileActivate']);
# Login
Route::post('login',['as' => 'frontend.auth.login','uses' => 'Frontend\AuthController@login']);
// Logout
Route::get('logout', array('as' => 'frontend.logout', 'uses' => 'Frontend\AuthController@logout'));
Route::get('/', array('as' => 'frontend.index', 'uses' => 'Frontend\HomeController@index'));
# Forget Password
Route::get('frontend/password/reset',['as' => 'frontend.auth.forget','uses' => 'Frontend\AuthController@forget']);
Route::post('frontend/password/reset',['as' => 'frontend.auth.reset','uses' => 'Frontend\AuthController@reset']);
# Reset Password Mail 
Route::get('/password/reset/{code}',['as' => 'reset','uses' => 'Frontend\AuthController@show']);
# change password
Route::post('frontend/password/change',['as' => 'frontend.auth.changePassword','uses' => 'Frontend\AuthController@changePassword']);

//Backend
//Route::get('backend', array('as' => 'backend', 'uses' => 'Backend\AuthController@backend'));
//Route::get('backend/dashboard', array('as' => 'backend.dashboard', 'uses' => 'Backend\HomepageController@dashboard'));

//Backend - Social Icon
Route::get('backend/socialicon', array('as' => 'backend.socialicon', 'uses' => 'Backend\SettingsController@index'));
Route::post('backend/socialicon/update-social-icons', array('as' => 'backend.socialicon', 'uses' => 'Backend\SettingsController@updateSocialIcons'));

//Backend Homepage
Route::get('backend/home_slider', array('as' => 'homesliders', 'uses' => 'Backend\HomepageController@sliders'));
Route::get('backend/home_slider/create', array('as' => 'backend.home_slider.create', 'uses' => 'Backend\HomepageController@createSlider'));
Route::post('backend/home_slider/store', array('as' => 'backend.home_slider.store', 'uses' => 'Backend\HomepageController@storeSlider'));
Route::get('backend/home_slider/delete/{id}', array('as' => 'backend.home_slider.delete', 'uses' => 'Backend\HomepageController@destroySlider'));
Route::get('backend/home_slider/edit/{id}', array('as' => 'backend.home_slider.edit', 'uses' => 'Backend\HomepageController@editSlider'));
Route::post('backend/home_slider/update/{id}', array('as' => 'backend.home_slider.update', 'uses' => 'Backend\HomepageController@updateSlider'));

//Backend Collection
Route::get('backend/collection', array('as' => 'backend.collection', 'uses' => 'Backend\CollectionController@index'));
Route::get('backend/collection/create', array('as' => 'backend.collection.create', 'uses' => 'Backend\CollectionController@createCollections'));
Route::post('backend/collection/store', array('as' => 'backend.collection.store', 'uses' => 'Backend\CollectionController@storeCollections'));
Route::get('backend/collection/edit/{id}', array('as' => 'backend.collection.edit', 'uses' => 'Backend\CollectionController@editCollections'));
Route::post('backend/collection/update/{id}', array('as' => 'backend.collection.update', 'uses' => 'Backend\CollectionController@updateCollections'));
Route::post('backend/collection/images/upload/{id}', array('as' => 'backend.collection.images', 'uses' => 'Backend\CollectionController@imageUpload'));
Route::post('backend/collection/image/delete/{id}', array('as' => 'backend.collection.image_delete', 'uses' => 'Backend\CollectionController@imageDelete'));
Route::get('backend/collection/delete/{id}', array('as' => 'backend.collection.delete', 'uses' => 'Backend\CollectionController@destroyCollections'));


//Backend Designer
Route::get('/backend/aboutdesigner',array('as'=>'backend.designer', 'uses'=>'Backend\DesignController@displayDesignerInfo'));
Route::post('backend/about_designer/update_info/{id}', array('as' => 'backend.about_designer', 'uses' => 'Backend\DesignController@updateDesignerInfo'));
Route::get('/backend/designer/edit',array('as'=>'backend.designer', 'uses'=>'Backend\DesignController@alterDesignerInfo'));

//Backend Press
Route::get('backend/press', array('as' => 'backend.press', 'uses' => 'Backend\PressController@index'));
Route::get('backend/press/create', array('as' => 'backend.press.create', 'uses' => 'Backend\PressController@createPressSlides'));
Route::post('backend/press/store', array('as' => 'backend.press.store', 'uses' => 'Backend\PressController@storePressSlides'));
Route::get('backend/press/delete/{id}', array('as' => 'backend.press.delete', 'uses' => 'Backend\PressController@destroyPressSlides'));

// Categories - Backend
Route::get('backend/maincategory/create', array('as' => 'backend.maincategory.create', 'uses' => 'Backend\CategoriesController@createCategory'));
Route::post('backend/maincategory/add', array('as' => 'backend.maincategory.add', 'uses' => 'Backend\CategoriesController@addCategory'));
Route::get('backend/categories', array('as' => 'backend.categories.index', 'uses' => 'Backend\CategoriesController@index'));
Route::get('backend/categories/new', array('as' => 'backend.categories.new', 'uses' => 'Backend\CategoriesController@create'));
Route::get('backend/categories/create/{id}', array('as' => 'backend.categories.create', 'uses' => 'Backend\CategoriesController@create'));
Route::post('backend/categories/store', array('as' => 'backend.categories.store', 'uses' => 'Backend\CategoriesController@postCreate'));
Route::get('backend/categories/edit/{id}', array('as' => 'backend.categories.edit', 'uses' => 'Backend\CategoriesController@edit'));
Route::patch('backend/categories/update/{id}', array('as' => 'backend.categories.update', 'uses' => 'Backend\CategoriesController@update'));
Route::get('backend/categories/{parent_id}', array('as' => 'backend.categories.sub', 'uses' => 'Backend\CategoriesController@categories'));
Route::get('backend/categories/delete/{id}', 'Backend\CategoriesController@destroy');

//Backend products
Route::get('backend/products', array('as' => 'backend.products.index', 'uses' => 'Backend\ProductsController@index'));
Route::get('backend/productlist/{category_id}',array('as'=>'backend.productlist.list','uses'=>'Backend\ProductsController@productlist'));
Route::get('backend/products/create/{category_id}',array('as'=>'backend.products.new','uses'=>'Backend\ProductsController@getCreate'));
Route::get('backend/products/csvimport/{category_id}',array('as'=>'backend.products.csvimport','uses'=>'Backend\ProductsController@CSVimport'));
Route::post('backend/products/importdata',array('as'=>'backend.products.importdata', 'uses'=>'Backend\ProductsController@CSVimportData'));
Route::post('backend/products/search',array('as'=>'backend.products.search', 'uses'=>'Backend\ProductsController@search'));


Route::post('backend/products/images/{id}',array('as'=>'backend.products.images','uses'=>'Backend\ProductsController@uploadImages'));
Route::patch('backend/products/images/{product_id}/{image_id}',array('as'=>'backend.products.images','uses'=>'Backend\ProductsController@updateImageInfo'));
Route::post('backend/products/line-drawings/{id}',array('as'=>'backend.products.line_drawing','uses'=>'Backend\ProductsController@uploadLineDrawing'));
Route::patch('backend/products/line-drawings/{product_id}/{image_id}',array('as'=>'backend.products.line_drawing','uses'=>'Backend\ProductsController@updateLineDrawing'));
Route::post('backend/products/attachments/{id}',array('as'=>'backend.products.attachments','uses'=>'Backend\ProductsController@uploadAttachment'));
Route::patch('backend/products/attachments/{product_id}/{attachment_id}',array('as'=>'backend.products.attachments','uses'=>'Backend\ProductsController@updateAttachment'));
//Route::post('backend/products/update-position/{id}',array('as'=>'backend.products.update_position','uses'=>'Backend\ProductsController@uploadAttachment'));
Route::post('backend/products/position/',array('as'=>'backend.products.image.position','uses'=>'Backend\ProductsController@ImagePositionUpdate'));
Route::post('backend/products/pdf/',array('as'=>'backend.products.pdf.position','uses'=>'Backend\ProductsController@PdfPositionUpdate'));
Route::post('backend/products/drawings/',array('as'=>'backend.products.line.position','uses'=>'Backend\ProductsController@LinePositionUpdate'));
Route::post('backend/products/caresymbols/',array('as'=>'backend.products.caresymbols','uses'=>'Backend\ProductsController@CareSymbolImagePosition'));



Route::post('backend/products/store',array('as'=>'backend.products.create','uses'=>'Backend\ProductsController@postCreate'));
Route::get('backend/products/edit/{id}',array('as'=>'backend.products.edit','uses'=>'Backend\ProductsController@edit'));
Route::patch('backend/products/seo_update/{id}',array('as'=>'backend.products.seo','uses'=>'Backend\ProductsController@seoUpdate'));
Route::patch('backend/products/update/{id}',array('as'=>'backend.products.update','uses'=>'Backend\ProductsController@update'));
Route::get('backend/products/delete/{id}',array('as'=>'backend.products.delete','uses'=>'Backend\ProductsController@destroy'));
Route::post('backend/products/attributes_update/{id}',array('as'=>'backend.products.attributes','uses'=>'Backend\ProductsController@attributesUpdate'));
Route::post('backend/products/attributes_price_update/{id}',array('as'=>'backend.products.attributesprice','uses'=>'Backend\ProductsController@attributesPriceUpdate'));

//Backend product
Route::get('backend/product', array('as' => 'product', 'uses' => 'Backend\ProductController@index'));
Route::get('backend/product', array('as' => 'backend.productadd', 'uses' => 'Backend\ProductController@index'));
Route::get('backend/product/create/{id}', array('as' => 'backend.product.create', 'uses' => 'Backend\ProductController@createSlides'));
Route::post('backend/product/store', array('as' => 'backend.product.store', 'uses' => 'Backend\ProductController@storeSlides'));
Route::get('backend/product/edit/{id}',array('as'=>'backend.product', 'uses'=>'Backend\ProductController@edit'));
Route::post('backend/about_product/update_info/{id}', array('as' => 'backend.product', 'uses' => 'Backend\ProductController@update_info'));
Route::get('backend/product/delete/{id}', array('as' => 'backend.product.delete', 'uses' => 'Backend\ProductController@destroySlides'));

//  - Backend Attributes
Route::get('backend/attibutes', array('as' => 'backend.attributes', 'uses' => 'Backend\ProductsController@attributes'));

//Backend attribute
Route::get('backend/attributes', array('as' => 'backend.attributes.index', 'uses' => 'Backend\AttributesController@index'));
Route::get('backend/attributes/create', array('as' => 'backend.attributes.new', 'uses' => 'Backend\AttributesController@create'));
Route::post('backend/attributes/store', array('as' => 'backend.attributes.create', 'uses' => 'Backend\AttributesController@store'));
Route::get('backend/attributes/edit/{id}', array('as' => 'backend.attributes.edit', 'uses' => 'Backend\AttributesController@edit'));
Route::post('backend/attributes/update/{id}', array('as' => 'backend.attributes.update', 'uses' => 'Backend\AttributesController@update'));
Route::get('backend/attributes/delete/{id}', array('as' => 'backend.attributes.delete', 'uses' => 'Backend\AttributesController@destroy'));

//Backend Admin Profile
Route::get('backend/users/index', array('as' => 'backend.users.index', 'uses' => 'Backend\ProfileController@index'));
Route::post('backend/users/create/', array('as' => 'backend.users.create', 'uses' => 'Backend\ProfileController@postCreate'));
Route::get('backend/users/create/', array('as' => 'backend.users.create', 'uses' => 'Backend\ProfileController@create'));
Route::get('backend/users/edit/{id}', array('as' => 'backend.users.edit', 'uses' => 'Backend\ProfileController@edit'));
Route::post('backend/users/update/{id}', array('as' => 'backend.users.update', 'uses' => 'Backend\ProfileController@update'));
Route::get('backend/users/delete/{id}', array('as' => 'backend.users.delete', 'uses' => 'Backend\ProfileController@destroy'));

//Profine Change password

Route::get('backend/users/change/', array('as' => 'backend.users.change', 'uses' => 'Backend\ProfileController@change'));
Route::get('backend/users/password/{id}', array('as' => 'backend.users.password', 'uses' => 'Backend\ProfileController@editUserPassword'));
Route::post('backend/password/update/{id}', array('as' => 'backend.password.update', 'uses' => 'Backend\ProfileController@passwordUpdate'));

// Attribute Values

Route::get('backend/attribute_values',array('as'=>'backend.attribute_values.index','uses'=>'Backend\AttributeValuesController@index'));
Route::get('backend/attribute_values/create',array('as'=>'backend.attribute_values.new','uses'=>'Backend\AttributeValuesController@create'));
Route::post('backend/attribute_values/store',array('as'=>'backend.attribute_values.create','uses'=>'Backend\AttributeValuesController@store'));
Route::get('backend/attribute_values/edit/{id}',array('as'=>'backend.attribute_values.edit','uses'=>'Backend\AttributeValuesController@edit'));
Route::post('backend/attribute_values/update/',array('as'=>'backend.attribute_values.update','uses'=>'Backend\AttributeValuesController@update'));
Route::get('backend/attribute_values/delete/{id}',array('as'=>'backend.attribute_values.delete','uses'=>'Backend\AttributeValuesController@destroy'));

//Frontend Category
Route::get('/dresses', array('as' => 'product', 'uses' => 'Frontend\ProductController@dresses'));
Route::get('/skirts', array('as' => 'product', 'uses' => 'Frontend\ProductController@skirts'));
Route::get('/trousers', array('as' => 'product', 'uses' => 'Frontend\ProductController@trousers'));
Route::get('/tops', array('as' => 'product', 'uses' => 'Frontend\ProductController@tops'));
Route::get('/coats', array('as' => 'product', 'uses' => 'Frontend\ProductController@coats'));

//Frontend Season
Route::get('/winter', array('as' => 'product', 'uses' => 'Frontend\ProductController@winter'));
Route::get('/summer', array('as' => 'product', 'uses' => 'Frontend\ProductController@summer'));
Route::get('/autumn', array('as' => 'product', 'uses' => 'Frontend\ProductController@autumn'));
Route::get('/spring', array('as' => 'product', 'uses' => 'Frontend\ProductController@spring'));

// Cart
Route::controller('cart', 'Frontend\CartController');


//Backend Users
Route::get('backend/usermanagement/show_user', array('as' => 'backend.usermanagement.show_user', 'uses' => 'Backend\UsersController@showuser'));
Route::post('backend/usermanagement/user_status/{id}',array('as'=>'backend.usermanagement.user_status','uses'=>'Backend\UsersController@userStatus'));
Route::get('backend/usermanagement/show_user/destroy_user/{id}',array('as'=>'backend.usermanagement.show_user.destroy_user','uses'=>'Backend\UsersController@destroyuser'));

// Coupon code
Route::get('backend/coupon-code', array('as' => 'backend.coupon-code', 'uses' => 'Backend\CouponCodeController@couponIndex'));
Route::get('backend/coupon-code/create', array('as' => 'backend.coupon-code.create', 'uses' => 'Backend\CouponCodeController@couponCreate'));
Route::post('backend/coupon-code/new', array('as' => 'backend.coupon-code.new', 'uses' => 'Backend\CouponCodeController@couponPostCreate'));
Route::get('backend/coupon-code/edit/{id}', array('as' => 'backend.coupon-code.edit', 'uses' => 'Backend\CouponCodeController@couponPostEdit'));
Route::post('backend/coupon-code/update/{id}', array('as' => 'backend.coupon-code.update', 'uses' => 'Backend\CouponCodeController@couponPostUpdate'));
Route::post('backend/coupon-code/save_user_list/{id}', array('as' => 'backend.coupon-code.save_user_list', 'uses' => 'Backend\CouponCodeController@userListSave'));


