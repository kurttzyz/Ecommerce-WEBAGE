<?php
// Admin Controllers
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

// Seller Controllers
use App\Http\Controllers\Sellers\SellerProductController;
use App\Http\Controllers\Sellers\SellerMainController;
use App\Http\Controllers\Sellers\SellerStoreController;
use App\Http\Controllers\Sellers\SellerCartController;
use App\Http\Controllers\Sellers\SellerOrderController;
use App\Http\Controllers\Sellers\SellerReviewController;

// Customer Controllers
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterSubCategoryController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\PaymentAPI;
use App\Http\Controllers\ReviewController;

// Main Controller
use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomepageController;

// admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(AdminMainController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/settings', 'setting')->name('admin.settings');
            Route::put('/setting/homepagesetting', 'updatehomepagesetting')->name('admin.homepagesetting.update');
            Route::get('/manage/users', 'manage_user')->name('admin.manage.user');
            Route::get('/manage/site_revenues', 'manage_revenues')->name('admin.manage.revenues');
            Route::get('/manage/stores', 'manage_stores')->name('admin.manage.store');
            Route::get('/cart/history', 'cart_history')->name('admin.cart.history'); 
            Route::get('/order/history', 'order_history')->name('admin.order.history'); 
            Route::delete('/user/{id}', 'destroy')->name('delete.user');
        });

        Route::controller(CategoryController::class)->group(function(){
            Route::get('/category/create', 'index')->name( 'category.create');
            Route::get('/category/manage', 'manage')->name('category.manage');
        });

        Route::controller(SubCategoryController::class)->group(function(){
            Route::get('/subcategory/create', 'index')->name('subcategory.create');
            Route::get('/subcategory/manage', 'manage')->name('subcategory.manage');
        });

        Route::controller(ProductController::class)->group(function(){
            Route::get('/product/manage', 'index')->name('product.manage');
            Route::get('/product/review', 'review_manage')->name('product.review.manage');
           
        });

        Route::controller(ProductAttributeController::class)->group(function(){
            Route::get('/productattribute/create', 'index')->name('productattribute.create');
            Route::get('/productattribute/manage', 'manage')->name('productattribute.manage');
            Route::post('/default/attribute/create', 'createattribute')->name('attribute.create');
            Route::get('/defaultattribute/{id}', 'showattribute')->name('show.attribute');
            Route::put('/defaultattribute/update/{id}', 'updateattribute')->name('update.attribute');
            Route::delete('/defaultattribute/delete/{id}', 'deleteattribute')->name('delete.attribute');
        });

        Route::controller(ProductDiscountController::class)->group(function(){
            Route::get('/discount/create', 'index')->name('discount.create');
            Route::get('/discount/manage', 'manage')->name('discount.manage');
            
        });

        Route::controller(MasterCategoryController::class)->group(function(){
            Route::post('/store/category', 'storecat')->name('store.cat');
            Route::get('/category/{id}', 'showcat')->name('show.cat');
            Route::put('/category/update/{id}', 'updatecat')->name('update.cat');
            Route::delete('/category/delete/{id}', 'deletecat')->name('delete.cat');
        });

        Route::controller(MasterSubCategoryController::class)->group(function(){
            Route::post('/store/subcategory', 'storesubcat')->name('store.subcat');
            Route::get('/subcategory/{id}', 'showsubcat')->name('show.subcat');
            Route::put('/subcategory/update/{id}', 'updatesubcat')->name('update.subcat');
            Route::delete('/subcategory/delete/{id}', 'deletesubcat')->name('delete.subcat');
            
        });
    });
    
});

// Authenticated Seller routes
Route::middleware(['auth', 'verified', 'rolemanager:seller'])->group(function(){
    Route::prefix('seller')->group(function(){
        Route::controller(SellerMainController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('seller.dashboard');
            Route::get('/revenue', 'sellerRevenue')->name('seller.payments');
            Route::get('/pending_history', 'pendingorder')->name('seller.order.pending');
            Route::get('/history', 'history')->name('seller.order.history');


            Route::get('/category/{category_name}', 'showcategoryproduct')->name('seller.category.products');
            Route::get('/category/view_product/{product_name}', 'viewproduct')->name('seller.category.view');
    
            //showing shops in customer routes
            Route::get('/store', 'viewstore')->name('seller.store.view');
            Route::get('/store/{slug}','showstore')->name('seller.store.show');
    
            //routes for searching products
            Route::get('/search/product',  'search')->name('seller.search.product');
            Route::get('/setting/payments', 'payment')->name('seller.payment');
            Route::get('/order/history', 'history')->name('seller.history');
            Route::get('/affiliates', 'affiliates')->name('seller.affiliates');
        }); 

        Route::controller(SellerReviewController::class)->group(function(){
            Route::post('/products/{product}/review', 'store')->name('seller.product.review.store');
    
        });

        Route::controller(PaymentAPI::class)->group(function () {
            Route::get('/checkout/GCASH',  'checkout')->name('seller.checkout');
            Route::get('/checkout',  'showCheckoutForm')->name('seller.checkout.form');
            Route::post('/checkout',  'processCheckout')->name('seller.checkout');
            Route::get('/checkout/success', function () { return 'Payment successful!';})->name('seller.checkout.success');
        });

        Route::controller(SellerCartController::class)->group(function () {
            Route::get('/cart', 'index')->name('seller.cart.index');
            Route::post('/cart/add/{product}','add')->name('seller.cart.add');
            Route::post('/cart/increase/{item}', 'increaseQuantity')->name('seller.cart.increase');
            Route::post('/cart/decrease/{item}', 'decreaseQuantity')->name('seller.cart.decrease');
            Route::delete('/cart/remove/{item}', 'removeItem')->name('seller.cart.remove');
        });

        Route::controller(SellerOrderController::class)->group(function () {
            Route::get('/orders/pending_orders','displayOrder')->name('seller.orders.order');
            Route::post('/orders/show/{order}','showOrder')->name('seller.orders.show');
            Route::post('/order/{order}/cancel', 'cancelOrder')->name('seller.order.cancel');
    
                // Route for payment and shipping
            Route::post('/orders/confirm_order', 'storeOrder')->name('seller.orders.payment');
            Route::post('/orders/payment/{order}', 'storeShippingAndPayment')->name('seller.orders.shipping_payment');
            Route::post('/orders/payment/confirm_order/{order}', 'createShippingAndPayment')->name('seller.orders.createshippingpayment');
            
            Route::get('/orders/shipping_information/{order}', 'yourorder')->name('seller.orders.showorder');
            Route::get('/orders/history', 'pendingorder')->name('seller.orders.pending');
           
        });

        Route::controller(SellerStoreController::class)->group(function(){
            Route::get('/your_store/create_store', 'index')->name('seller.store.create');
            Route::get('/your_store/manage', 'manage')->name('seller.store.manage');
            Route::post('/your_store/publish', 'store')->name('create.store');
            Route::get('/your_store/edit/{id}', 'editstore')->name('edit.store');
            Route::put('/your_store/update/{id}', 'updatestore')->name('update.store');
            Route::delete('/your_store/delete/{id}', 'deletestore')->name('delete.store');
        }); 

        Route::controller(SellerProductController::class)->group(function(){
            Route::get('/product/create', 'index')->name('seller.product');
            Route::get('/product/manage', 'manage')->name('seller.product.manage');
            Route::post('/product/store', 'storeproduct')->name('seller.product.store');
            Route::get('/product/edit/{id}', 'editproduct')->name('seller.product.edit');
            Route::put('/product/update/{id}', 'updateproduct')->name('update.product');
            Route::delete('/product/delete/{id}', 'deleteproduct')->name('delete.product');
        }); 
    });
});

// Un-Authenticated Users 
Route::controller(HomepageController::class)->group(function(){
    Route::get('/', 'index')->name('home');
});

// Authenticated Customer routes
Route::middleware(['auth', 'verified', 'rolemanager:customer'])->prefix('customer')->group(function () {
    Route::controller(CustomerMainController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('customer.dashboard');

        //category customer routes
        Route::get('/category/{category_name}', 'showcategoryproduct')->name('category.products');
        Route::get('/category/view_product/{product_name}', 'viewproduct')->name('category.view');

        //showing shops in customer routes
        Route::get('/store', 'viewstore')->name('customer.store.view');
        Route::get('/store/{slug}','showstore')->name('customer.store.show');

        //routes for searching products
        Route::get('/search/product',  'search')->name('customer.search.products');
        Route::get('/setting/payments', 'payment')->name('customer.payment');
        Route::get('/order/history', 'history')->name('customer.history');
        Route::get('/affiliates', 'affiliates')->name('customer.affiliates');
        });

    Route::controller(ReviewController::class)->group(function(){
        Route::post('/products/{product}/review', 'store')->name('product.review.store');

    });

    Route::controller(PaymentAPI::class)->group(function () {
        Route::get('/checkout/GCASH',  'checkout')->name('customer.checkout');
        Route::get('/checkout',  'showCheckoutForm')->name('customer.checkout.form');
        Route::post('/checkout',  'processCheckout')->name('customer.checkout');
        Route::get('/checkout/success', function () {
            return ' Payment successful! You can now redirect to order summary or thank you page.';
        })->name('customer.checkout.success');
    });

    //Route for add to cart
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/add/{product}','add')->name('cart.add');
        Route::post('/cart/increase/{item}', 'increaseQuantity')->name('cart.increase');
        Route::post('/cart/decrease/{item}', 'decreaseQuantity')->name('cart.decrease');
        Route::delete('/cart/remove/{item}', 'removeItem')->name('cart.remove');
    });
    // Route for making orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders/pending_orders','displayOrder')->name('customer.orders.order');
        Route::post('/orders/show/{order}','showOrder')->name('customer.orders.show');
        Route::post('/order/{order}/cancel', 'cancelOrder')->name('customer.order.cancel');

            // Route for payment and shipping
        Route::post('/orders/confirm_order', 'storeOrder')->name('customer.orders.payment');
        Route::post('/orders/payment/{order}', 'storeShippingAndPayment')->name('orders.shipping_payment');
        Route::post('/orders/payment/confirm_order/{order}', 'createShippingAndPayment')->name('orders.createshippingpayment');
        
        Route::get('/orders/shipping_information/{order}', 'yourorder')->name('orders.showorder');
        Route::get('/orders/history', 'pendingorder')->name('orders.pending');
       
    });


    // Route for editing customer informations
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

Route::get('/test-policy', function() {
    $orders = Order::first();
    return [
        'can_view' => Gate::allows('view', $orders),
        'can_update' => Gate::allows('update', $orders)
    ];
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
