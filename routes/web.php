<?php
// Admin Controllers

use App\Models\User;
use App\Models\Order;
use App\Models\Achievement;
use App\Models\Certificate;
use App\Http\Controllers\PaymentAPI;
use Illuminate\Support\Facades\Auth;

// Seller Controllers
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Achievements;
use App\Http\Controllers\Certificates;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Customer Controllers
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomepageController;

// Main Controller
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManageCertificates;
use App\Http\Controllers\MasterCategoryController;

use App\Http\Controllers\Sellers\CourseController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Sellers\MentorCertificate;
use App\Http\Controllers\Sellers\ActivityController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\MasterSubCategoryController;
use App\Http\Controllers\Sellers\AttendanceController;
use App\Http\Controllers\Sellers\SellerCartController;
use App\Http\Controllers\Sellers\SellerMainController;
use App\Http\Controllers\Sellers\SellerOrderController;
use App\Http\Controllers\Sellers\SellerStoreController;
use App\Http\Controllers\Sellers\SubmissionsController;
use App\Http\Controllers\Sellers\AnnouncementController;
use App\Http\Controllers\Sellers\SellerReviewController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\Seller\MentorAssignAchievements;
use App\Http\Controllers\Sellers\MentorSessionController;
use App\Http\Controllers\Sellers\SellerProductController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Sellers\SellerApplicationController;

// admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(AdminMainController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('admin');
            Route::get('/settings', 'setting')->name('admin.settings');
            Route::put('/setting/homepagesetting', 'updatehomepagesetting')->name('admin.homepagesetting.update');
            Route::get('/manage/site_revenues', 'manage_revenues')->name('admin.manage.revenues');
            Route::get('/manage/stores', 'manage_stores')->name('admin.manage.store');
            Route::get('/cart/history', 'cart_history')->name('admin.cart.history'); 
            Route::get('/order/history', 'order_history')->name('admin.order.history'); 
            Route::delete('/user/{id}', 'destroy')->name('delete.user');
            Route::get('/mentor_application_form', 'application_form')->name('admin.application_form');
            Route::get('/seller-forms/archived',  'archived')->name('forms.archived');
            Route::get('/seller_application_form', 'mentor_application_form')->name('admin.mentor_application_form');
            Route::post('/seller/approve/{id}', 'approve')->name('admin.approve');
            Route::post('/seller/decline/{id}', 'decline')->name('admin.decline');
            Route::get('/manage/users/{role?}','manage_user')->name('admin.users');
            Route::get('/users', 'manage_user')->name('admin.manage.user');
            Route::get('/create', 'create')->name('admin.create');
            Route::post('/store', 'store')->name('admin.store');
            Route::get('/users/{id}/edit',  'edit')->name('edit.user');
            Route::put('/users/{id}',  'update')->name('update.user');
            Route::post('/profile/upload', 'upload')->name('profile.admin.upload');
            Route::get('/users/{role?}', 'viewUsers')->name('admin.users.show');
            
        
        });

        Route::controller(CategoryController::class)->group(function(){
            Route::get('/category/create', 'index')->name( 'category.create');
            Route::get('/category/manage', 'manage')->name('category.manage');
        });

        Route::controller(ManageCertificates::class)->group(function(){
            Route::get('/{id}/certificates', 'studentCertificates')->name('certificates.admin');
            Route::get('/certificates', 'index')->name('manage.certificates');
            Route::delete('/admin/certificates/{id}', 'destroy')->name('certificates.destroy');

        });

        Route::controller(SubCategoryController::class)->group(function(){
            Route::get('/subcategory/create', 'index')->name('subcategory.create');
            Route::get('/subcategory/manage', 'manage')->name('subcategory.manage');
        });

        Route::controller(ProductController::class)->group(function(){
            Route::get('/course/manage', 'index')->name('product.manage');
            Route::get('/manage/achievements', 'review_manage')->name('product.review.manage');
            Route::get('/view/achievements', 'viewachievements')->name('achievements.show');
            Route::delete('/admin/review-delete/{id}', 'delete_review')->name('review.delete');
            Route::delete('/course/delete/{id}',  'destroy')->name('product.destroy');

           
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
    Route::prefix('mentor')->group(function(){
        Route::controller(SellerMainController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('seller.dashboard');
            Route::get('/revenue', 'sellerRevenue')->name('seller.payments');
            Route::get('/pending_history', 'pendingorder')->name('seller.order.pending');
            Route::get('/history', 'history')->name('seller.order.history');
            Route::post('/active_mentors/{store}/reviews', 'submitReview')->name('submit.reviews');
            Route::post('/profile/upload', 'upload')->name('profile.seller.upload');
            Route::get('/policies&guidelines', 'policy')->name('policies');
            Route::get('/contract&agreement', 'contract')->name('contract');

            Route::get('/category/{category_name}', 'showcategoryproduct')->name('seller.category.products');
            Route::get('/category/view_product/{product_name}', 'viewproduct')->name('seller.category.view');
    
            //showing shops in customer routes
            Route::get('/active_mentors', 'viewstore')->name('seller.store.view');
            Route::get('/active_mentors/{slug}','showstore')->name('seller.store.show');
    
            //routes for searching products
            Route::get('/search/course',  'search')->name('seller.search.product');
            Route::get('/setting/payments', 'payment')->name('seller.payment');
            Route::get('/order/history', 'history')->name('seller.history');
            Route::get('/affiliates', 'affiliates')->name('seller.affiliates');
            Route::patch('/submissions/{submission}/grade', [SubmissionController::class, 'updateGrade'])->name('submissions.updateGrade');

        }); 


        Route::controller(SellerApplicationController::class)->group(function(){
            //rotes for seller-form 
            Route::get('/mentor-form', 'seller_form')->name('seller.seller-form');
            Route::post('/mentor-form/submit', [SellerApplicationController::class, 'submitForm'])->name('seller.submitform');
    
        });

        Route::controller(ResponseController::class)->group(function(){
            Route::post('/announcements/{announcement}/respond', 'respond')->name('announcements.responds');
        });

        Route::controller(SellerReviewController::class)->group(function(){
            Route::post('/course/{product}/review', 'store')->name('seller.product.review.store');
    
        });
        
        Route::controller(MentorAssignAchievements::class)->group(function(){             
            Route::post('/achievements/{student}', 'show')->name('mentor.assign');
            Route::get('/achievement', 'index')->name('mentor.assign.index');
            Route::post('/achievements/{student_id}/assign',  'assign')->name('asign.achievements');
            Route::post('/mentor/assign-single', [MentorAssignAchievements::class, 'assignToSingleStudent'])->name('assign.achievement.single');
            Route::post('/create',  'store')->name('achievements.store');
            Route::get('/create/achievements',  'createa')->name('achievements.create');

        });


        Route::controller(CourseController::class)->group(function(){
            Route::get('/course', 'index')->name('courses.index');
            Route::get('/course-create', 'create')->name('courses.create');
            Route::post('/course-creates', 'store')->name('courses.store');
            Route::get('/course/edit/{course}', 'edit')->name('courses.edit');
            Route::put('/course/update/{course}', 'update')->name('courses.update');
            Route::get('/course/archive', 'showarchive')->name('courses.show.archive');
            Route::get('/course/{course}', 'show')->name('courses.show');
            Route::get('/course/{id}/students',  'students')->name('course.students');
            Route::post('/course/archive/{id}', 'archive')->name('courses.archive');
            Route::put('/course/unarchive/{id}', 'unarchive')->name('courses.unarchive');

    
        });

        Route::controller(ActivityController::class)->group(function(){
             Route::get('/session/{session}/activity/create', 'create')->name('activities.create');
             Route::post('/session/{session}/activity', 'store')->name('activities.store');
    
        });


        Route::controller(MentorSessionController::class)->group(function(){
            Route::get('/course/{courseId}/session/create', 'create')->name('sessions.create');
            Route::post('/course/{courseId}/session', 'store')->name('sessions.store');
        });

        Route::controller(MentorCertificate::class)->group(function(){
            Route::get('/certificates/create', 'create')->name('certificates.create');
            Route::post('/certificates/generate',  'generate')->name('certificates.generate');
            Route::get('/certificates/{id}',  'show')->name('certificates.show');
            Route::get('/certificates',  'index')->name('certificates.index');

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
            Route::get('/your_course/create_course', 'index')->name('seller.store.create');
            Route::get('/your_course/manage', 'manage')->name('seller.store.manage');
            Route::post('/your_course/publish', 'store')->name('create.store');
            Route::get('/your_course/edit/{id}', 'editstore')->name('edit.store');
            Route::put('/your_course/update/{id}', 'updatestore')->name('update.store');
            Route::delete('/your_course/delete/{id}', 'deletestore')->name('delete.store');
        }); 

        Route::controller(SellerProductController::class)->group(function(){
            Route::get('/featured-course/create', 'index')->name('seller.product');
            Route::get('/featured-course/manage', 'manage')->name('seller.product.manage');
            Route::post('/featured-course/store', 'storeproduct')->name('seller.product.store');
            Route::get('/featured-course/edit/{id}', 'editproduct')->name('seller.product.edit');
            Route::put('/featured-course/update/{id}', 'updateproduct')->name('update.product');
            Route::delete('/featured-course/delete/{id}', 'deleteproduct')->name('delete.product');
        }); 

        Route::controller(ActivityController::class)->group(function(){
            Route::get('courses/{course_id}/activities/create', 'create')->name('activity.create');
            Route::post('courses/{course_id}/activities',  'store')->name('activities.store');

        }); 

        Route::controller(AnnouncementController::class)->group(function(){
            Route::get('courses/{course}/announcements/create',  'create')->name('announcement.create');
            Route::post('courses/{course}/announcements',  'store')->name('announcement.store');
            Route::delete('/announcements/{id}',  'destroy')->name('announcement.destroy');


   
        }); 

        Route::controller(AttendanceController::class)->group(function(){
            Route::get('courses/{course}/attendance/create', 'create')->name('add.attendance');
            Route::post('courses/{course}/attendance', 'store')->name('store.attendance');
   
        }); 

        Route::controller(SubmissionsController::class)->group(function(){
            Route::get('/activity/{$activityId}/submissions',  'viewSubmissions')->name('view_submissions');
            Route::get('/submissions',  'index')->name('submissions');
   
        }); 

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
            Route::delete('/profile', 'destroy')->name('profile.destroy');
        });
    });
});

// Un-Authenticated Users 
Route::controller(HomepageController::class)->group(function(){
    Route::get('/policies&guidelines', 'policy')->name('policy');
    Route::get('/contract&agreement', 'contract')->name('contract');
    Route::get('/', 'welcome')->name('welcome'); 
});
// Verification Code sent
Route::controller(VerificationController::class)->group(function(){
    Route::get('/verify',  'form')->name('verification.form');
    Route::post('/verify-email',  'verify')->name('verify');
   

});

// Authenticated students routes
Route::middleware(['auth', 'verified', 'rolemanager:customer'])->prefix('student')->group(function () {
    Route::controller(CustomerMainController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('customer.dashboard');
        Route::get('/class', 'class')->name('customer.class');
        Route::get('/home', 'home');
        Route::post('/active_mentors/{store}/reviews', 'submitReview')->name('student.review');
        Route::post('/profile/upload', 'upload')->name('profile.upload');

        // Classes routes
        Route::get('/classroom/{course}', [CustomerMainController::class, 'showClassroom'])->name('classroom.show');

        //category customer routes
        Route::get('/category/{category_name}', 'showcategoryproduct')->name('category.products');
        Route::get('/category/view_course/{product_name}', 'viewproduct')->name('category.view');

        //showing shops in customer routes
        Route::get('/active_mentors', 'viewstore')->name('customer.store.view');
        Route::get('/active_mentors/{slug}','showstore')->name('customer.store.show');
        
        //routes for searching products
        Route::get('/search/course',  'search')->name('customer.search.products');
        Route::get('/setting/payments', 'payment')->name('customer.payment');
        Route::get('/order/history', 'history')->name('customer.history');
        Route::get('/affiliates', 'affiliates')->name('customer.affiliates');
        });



    Route::controller(ReviewController::class)->group(function(){
        Route::post('/course/{product}/review', 'store')->name('product.review.store');

    });


    Route::controller(Achievements::class)->group(function(){
        Route::get('/achievements', 'index')->name('achievements');
        Route::post('/achievements/{achievement}/progress',  'updateProgress')->name('update.achievement.progress');

    });


    Route::controller(Certificates::class)->group(function(){
        Route::get('/{id}/certificates', 'studentCertificates')->name('certificates.student');
        Route::get('/mycertificates', 'index')->name('certificates');
    });


   


    Route::controller(ResponseController::class)->group(function(){
        Route::post('/announcements/{announcement}/respond', 'respond')->name('announcements.respond');
    });



    Route::controller(PaymentAPI::class)->group(function () {
        Route::get('/checkout/GCASH',  'checkout')->name('customer.checkout');
        Route::get('/checkout/{session_id}', [PaymentAPI::class, 'showCheckoutForm'])->name('customer.checkout.form');
        Route::post('/checkout',  'processCheckout')->name('customer.checkouts');
        Route::get('/checkout/success', [PaymentAPI::class, 'paymentSuccess'])->name('customer.checkout.success');
        Route::get('/checkout/failure', 'paymentFailure')->name('customer.checkout.failure');
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

    Route::controller(SubmissionController::class)->group(function(){
        Route::post('/submit-work/{id}', 'submit')->name('submissions.store');
    
        });

    Route::controller(SessionController::class)->group(function(){
        Route::post('/session/enroll/{id}', 'enroll')->name('sessions.enroll');
    
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
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
 
    
});


Route::get('/test-notification', function () {
    $mentor = User::where('role', 'mentor')->first();
    $student = User::where('role', 'student')->first();
    $course = \App\Models\Course::first();

    $mentor->notify(new \App\Notifications\StudentEnrolled($course, $student));

    return 'Notification sent.';
});


require __DIR__.'/auth.php';
