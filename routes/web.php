<?php



use Illuminate\Support\Facades\Route;



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



Auth::routes(['register'=>false]);



Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');
Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');

// Reset password
Route::get('password-reset', 'FrontendController@showResetForm')->name('password.reset'); 
// Socialite 
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');
Route::get('/','FrontendController@home')->name('home');

// Frontend Routes
Route::get('/home', 'FrontendController@index');
Route::get('/fairway-wood','FrontendController@fairwayWood')->name('fairway-wood');
Route::get('/shop','FrontendController@fairwayWood')->name('shop');
Route::get('/allcatagory','FrontendController@allCatagory')->name('allcatagory');
Route::get('/product-category/{slug}','FrontendController@productCategory')->name('allcatagory');

Route::get('/product_category/{id}','FrontendController@productCategory')->name('product_category');
Route::get('/golf-balls','FrontendController@golfBalls')->name('golf-balls');

Route::get('/about-us','FrontendController@aboutUs')->name('about-us');
Route::get('/thankyou','FrontendController@thankyou')->name('thankyou');
Route::get('/thanks','FrontendController@thanks')->name('thanks');

Route::get('/thank-you','FrontendController@thankyou')->name('thankyou');
Route::get('/gallery','FrontendController@gallery')->name('gallery');
Route::get('/guarantee','FrontendController@guarantee')->name('guarantee');

Route::get('/affiliates','FrontendController@affiliates')->name('affiliates');
Route::get('/partners','FrontendController@partners')->name('partners');
Route::get('/delivery-information','FrontendController@deliveryInformation')->name('delivery-information');

Route::get('/privacy','FrontendController@privacy')->name('privacy');
Route::get('/terms','FrontendController@terms')->name('terms');
Route::get('/contact','FrontendController@contact')->name('contact');

Route::get('/returns','FrontendController@returns')->name('returns');
Route::get('/abandoned-cart','AbandonedCart@index')->name('returns');
Route::get('/send-mail-abandoned-cart','AbandonedCart@sendMailAbandonedCart')->name('send-mail-abandoned-cart');
Route::get('/story','FrontendController@ourStory')->name('story');

Route::get('/contact','FrontendController@contact')->name('contact');
Route::post('/contact/message','MessageController@store')->name('contact.store');
Route::post('/affiliates/message','MessageController@store')->name('affiliates.store');

Route::post('/returns/message','MessageController@store')->name('returns.store');
Route::post('/partners/message','MessageController@store')->name('partners.store');
Route::get('/shop/{slug}','FrontendController@productDetail')->name('product-detail');

Route::post('/product/search','FrontendController@productSearch')->name('product.search');
Route::get('/product-cat/{slug}','FrontendController@productCat')->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}','FrontendController@productSubCat')->name('product-sub-cat');

Route::get('/product-brand/{slug}','FrontendController@productBrand')->name('product-brand');

// Cart section
Route::get('/add-to-cart/{slug}','CartController@addToCart')->name('add-to-cart');
Route::post('/add-to-cart','CartController@singleAddToCart')->name('single-add-to-cart');
Route::get('cart-delete/{id}','CartController@cartDelete')->name('cart-delete');
Route::post('cart-update','CartController@cartUpdate')->name('cart.update');

// Route::get('/shop','FrontendController@shop')->name('shop');


Route::get('/cart',function(){
    return view('frontend.pages.cart');
})->name('cart');

// Wishlist
Route::get('/wishlist',function(){

    return view('frontend.pages.wishlist');

})->name('wishlist');

Route::get('/wishlist/{slug}','WishlistController@wishlist')->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}','WishlistController@wishlistDelete')->name('wishlist-delete');

Route::post('cart/order','OrderController@store')->name('cart.order');
Route::get('order/pdf/{id}','OrderController@pdf')->name('order.pdf');
Route::get('order/pdfPackingSlip/{id}','OrderController@pdfPackingSlip')->name('order.pdfPackingSlip');
Route::get('/income','OrderController@incomeChart')->name('product.order.income');

// Route::get('/user/chart','AdminController@userPieChart')->name('user.piechart');
Route::get('/product-grids','FrontendController@productGrids')->name('product-grids');
Route::get('/product-lists','FrontendController@productLists')->name('product-lists');
Route::match(['get','post'],'/filter','FrontendController@productFilter')->name('shop.filter');

// Order Track
Route::get('/product/track','OrderController@orderTrack')->name('order.track');
Route::post('product/track/order','OrderController@productTrackOrder')->name('product.track.order');

// Blog
Route::get('/blog','FrontendController@blog')->name('blog');
Route::get('/blog-detail/{slug}','FrontendController@blogDetail')->name('blog.detail');
Route::get('/blog/search','FrontendController@blogSearch')->name('blog.search');
Route::get('/blog/category/{id}','FrontendController@blogCategory')->name('blog.categorysearch');
Route::get('/blog/tags/{slug}','FrontendController@blogByTag')->name('blog.tagsearch');
Route::post('/blog/filter','FrontendController@blogFilter')->name('blog.filter');

// Blog Category
Route::get('blog-cat/{slug}','FrontendController@blogByCategory')->name('blog.category');

// Blog Tag
Route::get('blog-tag/{slug}','FrontendController@blogByTag')->name('blog.tag');

// NewsLetter
Route::post('/subscribe','FrontendController@subscribe')->name('subscribe');

// Product Review
Route::resource('/review','ProductReviewController');
Route::post('shop/{slug}/review','ProductReviewController@store')->name('review.store');

// Post Comment 
Route::post('post/{slug}/comment','PostCommentController@store')->name('post-comment.store');
Route::resource('/comment','PostCommentController');

// Coupon
Route::post('/coupon-store','CouponController@couponStore')->name('coupon-store');
Route::get('/coupon-delete/{id}','CouponController@couponDelete')->name('coupon-delete');


// Shipping Calculation

Route::post('/shipping-calculation','CountryController@getShippingDetails')->name('shipping-calculation');
Route::post('/shipping-stor', 'CountryController@shippingStore')->name('shipping-stor');



// Ajax for show state
Route::post('/show-state-country-wise', 'CountryController@showStateCountryWise')->name('show-state-country-wise');
Route::post('/setcurrency','FrontendController@setCurrency')->name('set-currency');

// Backend section start
Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');

    // user route
    Route::resource('users','UsersController');
    
    // Vendor
    Route::resource('vendor','VendorController');

    // Banner
    Route::resource('banner','BannerController');
    Route::resource('homepageimage','HomepageimageController');

    // Testimonial
    Route::resource('testimonial','TestimonialController');
    
    // Countries
    Route::resource('country','CountryController');
    
    // State
    Route::resource('state','StateController');
    
    // FAQ
    Route::resource('faq','FaqController');
    
    // Brand
    Route::resource('brand','BrandController');

     // Country view contient wise
     Route::get('/country_view_contient_wise', 'ShippingController@country_view_contient_wise')->name('country_view_contient_wise');

    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');

    // Category
    Route::resource('/category','CategoryController');
    
    // Product
    Route::resource('/product','ProductController');

    // FLEX ATTIBUTE
    Route::resource('/flex_attribute','FlexAttributeController');

    Route::delete('/product/{id}/remove-image', 'ProductController@removeImage')->name('product.removeImage');

    // Ajax for sub category
    Route::post('/category/{id}/child','CategoryController@getChildByParent');

    // POST category
    Route::resource('/post-category','PostCategoryController');

    // Post tag
    Route::resource('/post-tag','PostTagController');

    // Post
    Route::resource('/post','PostController');
    Route::resource('/enquiry','MessageController');
    Route::resource('/affiliates-enquiry','MessageController');
    Route::resource('/partners-enquiry','MessageController');
    
    
    
    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');

    // Order
    Route::resource('/order','OrderController');
    
    // Shipping
    Route::resource('/shipping','ShippingController');
    
    // Coupon
    Route::resource('/coupon','CouponController');
    
    // Product Content
    Route::get('productcont','AdminController@productcont')->name('productcont');
    Route::post('productcont/update','AdminController@productcontUpdate')->name('productcont.update');
    
    // Settings
    Route::get('settings','AdminController@settings')->name('settings');
    Route::get('homeheding','AdminController@homeheding')->name('homeheding');
    Route::get('morshinfo','AdminController@morshinfo')->name('morshinfo');
    Route::get('todaynesw','AdminController@todaynesw')->name('todaynesw');
    Route::get('video','AdminController@video')->name('video');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');
    Route::post('setting/homepageheding','AdminController@settingsHomepageheding')->name('settings.homepageheding.update');
    Route::post('setting/morshinfo','AdminController@morshinfoUpdate')->name('morshinfo.update');
    Route::post('setting/todaynesw','AdminController@todayneswUpdate')->name('todaynesw.update');
    Route::post('setting/video','AdminController@videoUpdate')->name('video.update');
    
    //home page popup
    Route::get('homepage_popup','AdminController@homepage_popup')->name('homepage_popup');
    Route::post('homepage_popup/update','AdminController@homepage_popupUpdate')->name('homepage_popup.update');
    Route::post('homepageimage/update/{id}','HomepageimageController@Update')->name('homepageimage.update');

    //home page about us
    Route::get('aboutus','AdminController@aboutus')->name('aboutus');
    Route::post('about/update','AdminController@aboutusUpdate')->name('aboutus.update');

    //home page our story
    Route::get('ourstory','AdminController@ourstory')->name('ourstory');
    Route::post('ourstory/update','AdminController@ourstoryUpdate')->name('ourstory.update');

    //home page golf information
    Route::get('homepage_golf_information','AdminController@homepageGolfInformation')->name('homepage_golf_information');
    Route::get('golfInformation/create','AdminController@golfInformationCreate')->name('golfInformation.create');
    Route::post('golfInformation/store','AdminController@golfInformationStore')->name('golfInformation.store');
    Route::get('golfInformation/edit/{id}','AdminController@golfInformationEdit')->name('golfInformation.edit');
    Route::post('golfInformation/update','AdminController@golfInformationUpdate')->name('golfInformation.update');
    Route::delete('golfInformation/delete/{id}','AdminController@golfInformationDelete')->name('golfInformation.delete');

    //drlivery information information
    Route::get('drlivery_information','AdminController@drliveryInformation')->name('drlivery_information');
    Route::get('drliveryinformation/edit/{id}','AdminController@drliveryinformationEdit')->name('drliveryinformation.edit');
    Route::post('drliveryinformation/update','AdminController@drliveryinformationUpdate')->name('drliveryinformation.update');

    //why choose
    Route::get('why_choose','AdminController@whyChoose')->name('why_choose');
    Route::get('whychoose/edit/{id}','AdminController@whychooseEdit')->name('whychoose.edit');
    Route::post('whychoose/update','AdminController@whychooseUpdate')->name('whychoose.update');

    //home page menu
    Route::get('menus','AdminController@menus')->name('menus');
    Route::get('menus/create','AdminController@menuCreate')->name('menus.create');
    Route::post('menu/store','AdminController@menuStore')->name('menu.store');
    Route::get('menus/edit/{id}','AdminController@menusEdit')->name('menus.edit');
    Route::get('menus/delete/{id}','AdminController@menusDelete')->name('menus.detele');
    Route::post('menus/update','AdminController@menusUpdate')->name('menus.update');
    Route::post('menus/drackanddrop','AdminController@menusDrackanddrop')->name('menus.drackanddrop');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');

    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');

    // Abonded Cart 
    Route::get('abondedcart', 'CartController@abondedcart')->name('abondedcart.index');


});

Route::get('cronjob_abondedcart_email', 'FrontendController@cronjob_abondedcart_email');

Route::get('/checkout','CartController@checkout')->name('checkout');

// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){

    Route::get('/checkout','CartController@checkout')->name('checkout');

    Route::get('/','HomeController@index')->name('user');

     // Profile
     Route::get('/profile','HomeController@profile')->name('user-profile');
     Route::post('/profile/{id}','HomeController@profileUpdate')->name('user-profile-update');

    //  Order
    Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');

    // Product Review
    Route::get('/user-review','HomeController@productReviewIndex')->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}','HomeController@productReviewDelete')->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}','HomeController@productReviewEdit')->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}','HomeController@productReviewUpdate')->name('user.productreview.update');

    
    // Post comment
    Route::get('user-post/comment','HomeController@userComment')->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}','HomeController@userCommentDelete')->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}','HomeController@userCommentEdit')->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}','HomeController@userCommentUpdate')->name('user.post-comment.update');

    
    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');


        // Paypal
        Route::get('/payment', 'PaypalController@payment')->name('payment');
        Route::get('/cancel', 'PaypalController@cancel')->name('payment.cancel');
        Route::get('/payment/success', 'PaypalController@success')->name('payment.success');


        Route::get('/stripe', 'StripePaymentController@stripe')->name('stripeform');
        Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post');


});


// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();

// });