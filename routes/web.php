<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserCouponController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\UserOrderController;

use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\SubSubCategoryController;
use App\Http\Controllers\backend\PagesController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\AdminOrderController;

use App\Http\Controllers\backend\AdminUserListController;
use App\Http\Controllers\backend\AdminNotificationController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\SubscribeController;
use App\Http\Controllers\backend\CountryDataController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\StaffController;
use App\Http\Controllers\backend\PosController;
use App\Http\Controllers\SafeBD\SafeBDUserController;


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


/* safebd */

Route::get('/', [FrontendController::class, 'safeBD'])->name('safeBd');

Route::get('/register', [SafeBDUserController::class, 'create'])->name('safeBd.create');
Route::post('/safebd/register', [SafeBDUserController::class, 'store'])->name('safeBd.store');
Route::get('/safebd/get-districts/{divisionId}', [SafeBDUserController::class, 'getDistricts'])->name('safeBd.getDistricts');
Route::get('/safebd/get-upazilas/{districtId}', [SafeBDUserController::class, 'getUpazilas'])->name('safeBd.getUpazilas');

Route::get('/SearchBlood', [SafeBDUserController::class, 'searchBlood'])->name('search.blood');
Route::get('/filterblood', [SafeBDUserController::class, 'filterBlood'])->name('blood.filter.results');

Route::get('/ourgoal', [SafeBDUserController::class, 'ourGoal'])->name('safebd.ourGoal');
Route::get('/documents', [SafeBDUserController::class, 'documents'])->name('safebd.documents');
Route::get('/donate', [SafeBDUserController::class, 'donate'])->name('safebd.donate');
Route::get('/nirbahiComity', [SafeBDUserController::class, 'nirbahiComity'])->name('safebd.nirbahiComity');
Route::get('/others', [SafeBDUserController::class, 'others'])->name('safebd.others');
Route::get('/contact', [SafeBDUserController::class, 'contact'])->name('safebd.contact');
Route::get('/photos', [SafeBDUserController::class, 'photos'])->name('safebd.photos');



/*================== Start Frontend All Route ==============*/

Route::get('/home', [FrontendController::class, 'index'])->name('home');

/*================== Multi Language All Routes =================*/
Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('bangla.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

/* =============== Product Details Show ============= */
Route::get('product-details/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');

/* =============== Product view all Show ============= */
Route::get('product-view-all', [FrontendController::class, 'productViewAll'])->name('product.view.all');


/* =============== Start Product View Modal With Ajax ============== */
Route::get('/product/view/modal/{id}', [FrontendController::class, 'ProductViewAjax']);

/* ============ Start Add To Cart Store Data With Ajax  ============= */
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart'])->name('cart.add');

/* ============  Add to cart store data For Product Details Page With Ajax ============= */
Route::post('/dcart/product/details/store/{id}', [CartController::class, 'AddToCartDetails'])->name('cart.details.add');

/* ============ Start Mini Cart With Ajax  ============= */
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart'])->name('minicart.add');
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart'])->name('minicart.remove');

/* ============ Cart Show   ============= */
Route::get('/cart', [CartController::class, 'index'])->name('cart.show');
/* ============ Cart Get Product   ============= */
Route::get('/get-cart-product', [CartController::class, 'getCartProduct'])->name('getcart.product');

/* ============  Cart Increment  ============= */
Route::get('/cart-increment/{rowId}', [CartController::class, 'cartIncrement'])->name('cart.decrement');
/* ============  Cart Decrement  ============= */
Route::get('/cart-decrement/{rowId}', [CartController::class, 'cartDecrement'])->name('cart.decrement');
/* ============ Cart Remove   ============= */
Route::get('/cart-remove/{rowId}', [CartController::class, 'removeCartProduct'])->name('cart.remove');

/* ================= START COUPON OPTIONS ====================== */
Route::post('/coupon-apply', [UserCouponController::class, 'CouponApply']);
Route::get('/coupon-calculation', [UserCouponController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [UserCouponController::class, 'CouponRemove']);
/* ================= END COUPON OPTIONS ====================== */

/* ============  Get Cart Checkout Product   ============= */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
/* ============ Get Cart Checkout Product   ============= */

/* ============  Start Page Options   ============= */
Route::get('/page/{slug}', [FrontendController::class, 'pageAbout'])->name('page.about');
/* ============  End Page Options   ============= */

/* ============  Start Blog Options   ============= */
Route::get('/single-blog/{slug}', [FrontendController::class, 'pageBlog'])->name('blog.details');
/* ============  End Blog Options   ============= */

/*================   START DIVISION WITH DISTRICT/UPAZILA/UNION ROUTE   ==================*/
Route::get('/division-district/ajax/{division_id}', [CheckoutController::class, 'getdivision'])->name('division.ajax');
Route::get('/district-upazilla/ajax/{district_id}', [CheckoutController::class, 'getupazilla'])->name('upazilla.ajax');
Route::get('/upazilla-union/ajax/{upazilla_id}', [CheckoutController::class, 'getunion'])->name('union.ajax');
/*================   END DIVISION WITH DISTRICT/UPAZILA/UNION ROUTE   ==================*/

/* =============== Start Payment Getway All Route ============= */
Route::post('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{id}', [CheckoutController::class, 'show'])->name('checkout.success');
/* =============== End Payment Getway All Route ============= */

/* =============== Start Category WiseProduct Show Route ============= */
Route::get('/category/product/{slug}', [FrontendController::class, 'CatWiseProduct'])->name('product.category');
Route::get('/subcategory/product/{slug}', [FrontendController::class, 'SubCatWiseProduct'])->name('product.subcategory');
Route::get('/childcategory/product/{slug}', [FrontendController::class, 'ChildCatWiseProduct'])->name('product.childcategory');
/* =============== End Category WiseProduct Show Route ============= */

/* =============== Product Search  ============= */
Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
/* =============== Advance Search ============= */
Route::post('search-product', [FrontendController::class, 'advanceProduct']);

/* =============== User Order Tracking Search ============= */
Route::get('/user/track/order', [OrderTrackingController::class, 'UserTrackOrder'])->name('user.track.order');
Route::post('/order/tracking', [OrderTrackingController::class, 'OrderTracking'])->name('order.tracking');

/* =============== User return order ============= */
Route::post('/return/order/{order_id}', [OrderTrackingController::class, 'ReturnOrder'])->name('return.order');
Route::get('/return/order/page', [OrderTrackingController::class, 'ReturnOrderPage'])->name('return.order.page');

/* =============== User subscribe route ============= */
Route::post('/subscribe/store', [FrontendController::class, 'SubsStore'])->name('subs.store');


/* ================ START ADD TO COMPARE WITH AJAX ============== */
Route::get('/compare', [CompareController::class, 'index'])->name('compare');
Route::get('/compare/reset', [CompareController::class, 'reset'])->name('compare.reset');
Route::post('/compare/addToCompare/{id}', [CompareController::class, 'addToCompare'])->name('compare.addToCompare');
/* ================ END ADD TO COMPARE WITH AJAX ============== */

/* ================ START ADD TO WishList WITH AJAX ============== */
Route::post('/add-to-wishlist/{id}', [WishlistController::class, 'AddToWishList']);
Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
Route::get('/wishlist', [WishlistController::class, 'AllWishlist'])->name('wishlist');
Route::get('/wishlist-remove/{id}', [WishlistController::class, 'WishlistRemove'])->name('wishlist.remove');
/* ================ END ADD TO WishList WITH AJAX ============== */


/* =============== Start Customer Review Controller  ============= */
Route::post('/store/review', [ReviewController::class, 'store'])->name('store.review');
/* =============== End Customer Review Controller  ============= */

// register username check //
Route::get('/check/register/refer/{username}', [UserController::class, 'checkRegisterUsername']);
// register refer by check //
Route::get('check/register/refer/by/user/{referby}', [UserController::class, 'checkRegisterReferBy']);
// register placement by check //
Route::get('check/register/placement/{placement_id}', [UserController::class, 'RegisterPlacement']);

/// User Dashboard
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');

    // end user convert all route //

    Route::get("/user/dashboard", [HomeController::class, 'index'])->name('user.home');
    Route::get("/user/logout", [HomeController::class, 'UserLogout'])->name('user.logout');

    // user profile all route //
    Route::get("/user/profile/view", [HomeController::class, 'profileView'])->name('user.profile.view');
    Route::get("/user/profile/edit", [HomeController::class, 'profileEdit'])->name('user.profile.edit');
    Route::post("/user/profile/update/{id}", [HomeController::class, 'profileUpdate'])->name('user.profile.update');

    // user password change route //
    Route::get("/user/password/change", [HomeController::class, 'UserChangePassword'])->name('user.password.change');
    Route::post("/user/password/update", [HomeController::class, 'UserUpdatePassword'])->name('user.update.password');


    /* ================ start  user orders all route =============== */
    Route::get('/user/order/view', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/user/orders/{invoice_no}', [UserOrderController::class, 'orderView'])->name('order.view');
    /* ================ end  user orders all route =============== */

    /* ================ start  user invoice all route =============== */
    Route::get('/invoice/download/{order_id}', [UserOrderController::class, 'UserOrderInvoice'])->name('order.invoice.download');
    /* ================ end  user invoice all route =============== */
});

/// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashobard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});

/// Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {

    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashobard');
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
});


/* =============== Admin & Vendor Login ============== */
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');



/* =============== Admin All Route ============== */
Route::middleware(['auth', 'role:admin'])->group(function () {

    /* ==================== Admin Setting All Routes =================== */
    Route::prefix('setting')->group(function () {

        Route::get("/general/settings", [SettingController::class, 'index'])->name('setting.index');
        Route::post("/general/settings", [SettingController::class, 'update'])->name('setting.update');
        Route::get("/color/settings", [SettingController::class, 'colorIndex'])->name('color.index');
        Route::post("/color/settings/update/{id}", [SettingController::class, 'colorUpdate'])->name('color_settings.update');
    });

    /* ==================== Admin Slider All Routes =================== */
    Route::prefix('slider')->group(function () {
        Route::get('/index', [SliderController::class, 'index'])->name('slider.index')->middleware('permission:slider.index');;
        Route::get('/create', [SliderController::class, 'create'])->name('slider.create')->middleware('permission:slider.create');;
        Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::get('/view/{id}', [SliderController::class, 'view'])->name('slider.view');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
        Route::get('/slider_active/{id}', [SliderController::class, 'active'])->name('slider.active');
        Route::get('/slider_inactive/{id}', [SliderController::class, 'inactive'])->name('slider.in_active');
    });

    /* ==================== Admin Category All Routes =================== */
    Route::prefix('category')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/view/{id}', [CategoryController::class, 'view'])->name('category.view');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/category_active/{id}', [CategoryController::class, 'active'])->name('category.active');
        Route::get('/category_inactive/{id}', [CategoryController::class, 'inactive'])->name('category.in_active');
    });

    /* ==================== Admin SubCategory All Routes =================== */
    Route::prefix('subcategory')->group(function () {
        Route::get('/index', [SubCategoryController::class, 'index'])->name('subcategory.index');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/view/{id}', [SubCategoryController::class, 'view'])->name('subcategory.view');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
        Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');
        Route::get('/subcategory_active/{id}', [SubCategoryController::class, 'active'])->name('subcategory.active');
        Route::get('/subcategory_inactive/{id}', [SubCategoryController::class, 'inactive'])->name('subcategory.in_active');
        Route::get('/category-subcategory/ajax/{category_id}', [SubCategoryController::class, 'getsubcategory'])->name('subcategory.ajax');
    });

    /* ==================== Admin SubSubCategory All Routes =================== */
    Route::prefix('subsubcategory')->group(function () {
        Route::get('/index', [SubSubCategoryController::class, 'index'])->name('subsubcategory.index');
        Route::get('/create', [SubSubCategoryController::class, 'create'])->name('subsubcategory.create');
        Route::post('/store', [SubSubCategoryController::class, 'store'])->name('subsubcategory.store');
        Route::get('/view/{id}', [SubSubCategoryController::class, 'view'])->name('subsubcategory.view');
        Route::get('/edit/{id}', [SubSubCategoryController::class, 'edit'])->name('subsubcategory.edit');
        Route::post('/update/{id}', [SubSubCategoryController::class, 'update'])->name('subsubcategory.udate');
        Route::get('/delete/{id}', [SubSubCategoryController::class, 'destroy'])->name('subsubcategory.delete');
        Route::get('/subsubcategory_active/{id}', [SubSubCategoryController::class, 'active'])->name('subsubcategory.active');
        Route::get('/subsubcategory_inactive/{id}', [SubSubCategoryController::class, 'inactive'])->name('subsubcategory.in_active');
    });

    /* ==================== Admin Pages  All Routes =================== */
    Route::prefix('pages')->group(function () {
        Route::get('/index', [PagesController::class, 'index'])->name('pages.index');
        Route::get('/create', [PagesController::class, 'create'])->name('pages.create');
        Route::post('/store', [PagesController::class, 'store'])->name('pages.store');
        Route::get('/view/{id}', [PagesController::class, 'view'])->name('pages.view');
        Route::get('/edit/{id}', [PagesController::class, 'edit'])->name('pages.edit');
        Route::post('/update/{id}', [PagesController::class, 'update'])->name('pages.update');
        Route::get('/delete/{id}', [PagesController::class, 'delete'])->name('pages.delete');
        Route::get('/pages_active/{id}', [PagesController::class, 'active'])->name('pages.active');
        Route::get('/pages_inactive/{id}', [PagesController::class, 'inactive'])->name('pages.in_active');
    });

    /* ==================== Admin Brand All Routes =================== */
    Route::prefix('brand')->group(function () {
        Route::get('/index', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::get('/view/{id}', [BrandController::class, 'view'])->name('brand.view');
        Route::get('/view/{id}', [BrandController::class, 'view'])->name('brand.view');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
        Route::get('/brand_active/{id}', [BrandController::class, 'active'])->name('brand.active');
        Route::get('/brand_inactive/{id}', [BrandController::class, 'inactive'])->name('brand.in_active');
    });

    /* ==================== Admin  Blog All Routes =================== */
    Route::prefix('blog')->group(function () {
        Route::get('/index', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::post('/update/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
        Route::get('/blog_active/{id}', [BlogController::class, 'active'])->name('blog.active');
        Route::get('/blog_inactive/{id}', [BlogController::class, 'inactive'])->name('blog.in_active');
        Route::get('/view/{id}', [BlogController::class, 'view'])->name('blog.view');
    });

    /* ==================== Admin  Product All Routes =================== */
    Route::prefix('products')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/view/{id}', [ProductController::class, 'show'])->name('product.view');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
        Route::get('/product_active/{id}', [ProductController::class, 'active'])->name('product.active');
        Route::get('/product_inactive/{id}', [ProductController::class, 'inactive'])->name('product.in_active');

        // For Product Stock
        Route::get('/product/stock', [ProductController::class, 'ProductStock'])->name('product.stock');


        /* ================  Category & Subcategory With Ajax ================== */
        Route::get('/category-subcategory/ajax/{category_id}', [ProductController::class, 'getsubcategory'])->name('subcategory.product.ajax');
        Route::get('/subcategory-subsubcategory/ajax/{subcategory_id}', [ProductController::class, 'getsubsubcategory'])->name('subsubcategory.product.ajax');

        /* ================  Start Product Ajax All Store ================== */
        Route::post('/category/insert', [ProductController::class, 'categoryInsert'])->name('product.category.store');
        Route::post('/subcategory/insert', [ProductController::class, 'subcategoryInsert'])->name('product.subcategory.store');
        Route::post('/subsubcategory/insert', [ProductController::class, 'subsubcategoryInsert'])->name('product.subsubcategory.store');
        Route::post('/brand/insert', [ProductController::class, 'brandInsert'])->name('product.brand.store');
        /* ================  End Product Ajax All Store ================== */
    });

    /* ==================== Admin  Banner All Routes =================== */
    Route::prefix('banner')->group(function () {
        Route::get('/index', [BannerController::class, 'index'])->name('banner.index');
        Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
        Route::get('/view/{id}', [BannerController::class, 'view'])->name('banner.view');
        Route::get('/view/{id}', [BannerController::class, 'view'])->name('banner.view');
        Route::post('/update/{id}', [BannerController::class, 'update'])->name('banner.update');
        Route::get('/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');
        Route::get('/banner_active/{id}', [BannerController::class, 'active'])->name('banner.active');
        Route::get('/banner_inactive/{id}', [BannerController::class, 'inactive'])->name('banner.in_active');
    });

    /* ================  Admin Coupon All Route ================== */
    Route::prefix('coupon')->group(function () {
        Route::get('/index', [CouponController::class, 'index'])->name('coupon.index');
        Route::get('/create', [CouponController::class, 'create'])->name('coupon.create');
        Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
        Route::get('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');

        Route::get('/coupon_active/{id}', [CouponController::class, 'active'])->name('coupon.active');
        Route::get('/coupon_inactive/{id}', [CouponController::class, 'inactive'])->name('coupon.in_active');
        Route::get('/coupon/{id}', [CouponController::class, 'view'])->name('coupon.view');
    });

    /* ================  Start User Orders All Route ================== */
    Route::prefix('orders')->group(function () {
        // Orders All Route
        Route::get('/all_orders', [AdminOrderController::class, 'index'])->name('order.index');
        Route::get('/all_orders/{id}/show', [AdminOrderController::class, 'show'])->name('order.show');

        Route::get('/orders_delete/{id}', [AdminOrderController::class, 'destroy'])->name('order.delete');
        Route::post('/orders_update/{id}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
        Route::get('/invoice/{id}', [AdminOrderController::class, 'invoice_download'])->name('invoice.download');
        Route::get('/invoice/show/{id}', [AdminOrderController::class, 'invoice_show'])->name('invoice.show');

        // payment status
        Route::post('/orders/update_payment_status', [AdminOrderController::class, 'update_payment_status'])->name('orders.update_payment_status');
        // delivery status
        Route::post('/orders/update_delivery_status', [AdminOrderController::class, 'update_delivery_status'])->name('orders.update_delivery_status');

        /*================   START DIVISION WITH DISTRICT/UPAZILA/UNION ROUTE   ==================*/
        Route::get('/division-district/ajax/{division_id}', [AdminOrderController::class, 'getdivision'])->name('division.ajax');
        Route::get('/district-upazilla/ajax/{district_id}', [AdminOrderController::class, 'getupazilla'])->name('upazilla.ajax');
        Route::get('/upazilla-union/ajax/{upazilla_id}', [AdminOrderController::class, 'getunion'])->name('union.ajax');
        /*================   END DIVISION WITH DISTRICT/UPAZILA/UNION ROUTE   ==================*/

        // Return Orders All Route
        Route::get('/return/request', [AdminOrderController::class, 'ReturnRequest'])->name('return.request');
        Route::get('/return/request/approved/{order_id}', [AdminOrderController::class, 'ReturnRequestApproved'])->name('return.request.approved');
        Route::get('/complete/return/request', [AdminOrderController::class, 'CompleteReturnRequest'])->name('complete.return.request');
    });
    /* ================  End User Orders All Route ================== */
    /* ================  Admin user list All Route ================== */
    Route::prefix('userlist')->group(function () {
        Route::get("/index", [AdminUserListController::class, 'userList'])->name('admin.user.index');
        Route::get("/edit/{id}", [AdminUserListController::class, 'userEdit'])->name('admin.user.edit');
        Route::post("/update/{id}", [AdminUserListController::class, 'userUpdate'])->name('admin.user.update');
    });
    /* ================  End user list All Route ================== */

    /* ================  Admin order notifications  All Route ================== */
    Route::prefix('notification')->group(function () {

        Route::get('/all-notification', [AdminNotificationController::class, 'index'])->name('admin.all-notification');
    });
    /* ================  End order notifications  All Route ================== */

    /* ================  Start Admin order report  All Route ================== */
    Route::prefix('order-report')->group(function () {
        Route::get("/report/view", [ReportController::class, 'ReportView'])->name('report.view');
        Route::post("/search/by/date", [ReportController::class, 'SearchByDate'])->name('search-by-date');
        Route::post("/search/by/month", [ReportController::class, 'SearchByMonth'])->name('search-by-month');
        Route::post("/search/by/year", [ReportController::class, 'SearchByYear'])->name('search-by-year');
    });
    /* ================  End Admin order report  All Route ================== */

    /* ================  Start Admin Reviw All Route ================== */
    Route::prefix('review')->group(function () {
        Route::get('/pending/review', [ReviewController::class, 'PendingReview'])->name('pending.review');
        Route::get('/review/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');
        Route::get('/publish/review', [ReviewController::class, 'PublishReview'])->name('publish.review');
        Route::get('/review/delete/{id}', [ReviewController::class, 'ReviewDelete'])->name('review.delete');
    });
    /* ================  End Admin Reviw All Route ================== */

    /* ================  Start Subscriber All Route ================== */
    Route::prefix('subscribes')->group(function () {

        Route::get('/index', [SubscribeController::class, 'index'])->name('subscribe.index');
        Route::post('/store', [SubscribeController::class, 'store'])->name('subscribe.store');
        Route::get('/subscribe-delete/{id}', [SubscribeController::class, 'destroy'])->name('subscribe.delete');
    });
    /* ================  End Subscriber All Route ================== */

    /* ================  Start Backend Division/District/Upazilla All Route ================== */
    // Add Division
    Route::get('division/view', [CountryDataController::class, 'index'])->name('admin.division.view');
    Route::post('division/add/store', [CountryDataController::class, 'StoreDivision'])->name('admin.division.store');
    Route::get('division/delete/{id}', [CountryDataController::class, 'DivisionDelete'])->name('admin.division.delete');

    // Add District
    Route::get('district/view', [CountryDataController::class, 'DistrictIndex'])->name('admin.district.view');
    Route::post('district/add/store', [CountryDataController::class, 'StoreDistrict'])->name('admin.district.store');
    Route::get('district/delete/{id}', [CountryDataController::class, 'districtDelete'])->name('admin.district.delete');

    // Add Sub District
    Route::get('subdistrict/view', [CountryDataController::class, 'SubdistrictIndex'])->name('admin.subdistrict.view');
    Route::post('subdistrict/add/store', [CountryDataController::class, 'StoreSubdistrict'])->name('admin.subdistrict.store');
    Route::get('subdistrict/delete/{id}', [CountryDataController::class, 'SubdistrictDelete'])->name('admin.subdistrict.delete');
    Route::get('subdistrict/ajax/{id}', [CountryDataController::class, 'SubdistrictAjax'])->name('admin.subdistrict.ajax');

    // Add Union
    Route::get('union/view', [CountryDataController::class, 'UnionIndex'])->name('admin.union.view');
    Route::post('union/add/store', [CountryDataController::class, 'StoreUnion'])->name('admin.union.store');
    Route::get('union/delete/{id}', [CountryDataController::class, 'UnionDelete'])->name('admin.union.delete');
    Route::get('union/ajax/{id}', [CountryDataController::class, 'Unionajax'])->name('admin.union.ajax');
    Route::get('upzilatounion/ajax/{id}', [CountryDataController::class, 'UpzilatoUnionjax'])->name('admin.upzilatounion.ajax');
    /* ================  End Backend Division/District/Upazilla All Route ================== */

    /* ================  Start Permission All Route ================== */
    Route::prefix('permission')->group(function () {
        Route::get('/create', [RoleController::class, 'AddPermission'])->name('add.permission');
        Route::post('/store', [RoleController::class, 'StorePermission'])->name('permission.store');
        Route::get('/index', [RoleController::class, 'AllPermission'])->name('all.permission');
        Route::get('/edit/{id}', [RoleController::class, 'EditPermission'])->name('edit.permission');
        Route::post('/update/{id}', [RoleController::class, 'UpdatePermission'])->name('permission.update');
        Route::get('/delete/{id}', [RoleController::class, 'DeletePermission'])->name('delete.permission');
    });
    /* ================  End Permission All Route ================== */

    /* ================  Start Roles All Route ================== */
    Route::prefix('roles')->group(function () {
        Route::get('/create', [RoleController::class, 'AddRoles'])->name('add.roles');
        Route::post('/store', [RoleController::class, 'StoreRoles'])->name('roles.store');
        Route::get('/index', [RoleController::class, 'AllRoles'])->name('all.roles');
        Route::get('/edit/{id}', [RoleController::class, 'EditRoles'])->name('edit.roles');
        Route::post('/update/{id}', [RoleController::class, 'UpdateRoles'])->name('roles.update');
        Route::get('/delete/{id}', [RoleController::class, 'DeleteRoles'])->name('delete.roles');
    });
    /* ================  End Roles All Route ================== */


    /* ================  Start Add Roles in Permission All Route ================== */
    Route::prefix('roles-permission')->group(function () {
        Route::get('/create', [RoleController::class, 'AddRolesPermission'])->name('add.roles.permission');
        Route::post('/store', [RoleController::class, 'StoreRolesPermission'])->name('role.permission.store');
        Route::get('/index', [RoleController::class, 'AllRolesPermission'])->name('all.roles.permission');
        Route::get('/edit/{id}', [RoleController::class, 'AdminEditRoles'])->name('admin.edit.roles');
        Route::post('/update/{id}', [RoleController::class, 'RolePermissionUpdate'])->name('role.permission.update');
        Route::get('/delete/{id}', [RoleController::class, 'AdminDeleteRoles'])->name('admin.delete.roles');
    });
    /* ================  End Add Roles in Permission All Route ================== */

    /* ================  Start Admin Staff All Route  ================== */
    Route::prefix('staffs')->group(function () {
        Route::get('/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/store', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/index', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
        Route::post('/update/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::get('/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
    });
    /* ================  End Admin Staff All Route  ================== */

    /* ================  Start Admin Post All Route  ================== */
    Route::prefix('pos')->group(function () {
        Route::get('/create', [PosController::class, 'create'])->name('pos.create');
        Route::get('/customer/product/{id}', [PosController::class, 'getProduct'])->name('customer.pos.getProduct');
        Route::get('/customer/get-products', [PosController::class, 'filter'])->name('customer.pos.filter');
        Route::POST('/customer/pos/store', [PosController::class, 'store'])->name('customer.pos.store');

        Route::post('/store', [PosController::class, 'store'])->name('staff.store');
        Route::get('/index', [PosController::class, 'index'])->name('poin-of-sales.index');
        Route::get('/all/orders', [PosController::class, 'allOrders'])->name('poin-of-sales.all.orders');
        Route::get('/edit/{id}', [PosController::class, 'edit'])->name('staff.edit');
        Route::post('/update/{id}', [PosController::class, 'update'])->name('staff.update');
        Route::get('/delete/{id}', [PosController::class, 'destroy'])->name('staff.destroy');
    });
    /* ================  End Admin Post All Route  ================== */
}); // Admin End Middleware

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';