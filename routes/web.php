<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ThankyouController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserOrderDetailsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\MyblogController;
use App\Http\Controllers\Admin\MyserviceController;
use App\Http\Controllers\Admin\AboutServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\MpesaCallbackController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/cart', [cartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/thankyou', [ThankyouController::class, 'index']);


// Public routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/aboutus', [AboutController::class, 'index']);
Route::get('/error', [ErrorController::class, 'index']);
Route::get('/service', [ServiceController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//subject
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart');
    Route::post('/cart/add', 'add')->name('cart.add');
    Route::delete('/cart/remove/{id}', 'remove')->name('cart.remove');
    Route::put('/cart/update/{id}', 'updateQuantity')->name('cart.update');
    Route::post('/cart/clear', 'clear')->name('cart.clear');
    Route::get('/cart/data', 'getCartData')->name('cart.data');
});
Route::get('/products.index', [ProductController::class, 'index'])->name('products.index');

Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/admin/appointments', [\App\Http\Controllers\AppointmentController::class, 'index'])->name('admin.appointments');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::prefix('admin/products')->name('admin.products.')->group(function () {
    Route::get('/', [ProductController::class, 'adminIndex'])->name('index'); // admin.products.index
    Route::get('/create', [ProductController::class, 'create'])->name('create'); // admin.products.create
    Route::post('/', [ProductController::class, 'store'])->name('store'); // admin.products.store
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit'); // admin.products.edit
    Route::put('/{product}', [ProductController::class, 'update'])->name('update'); // admin.products.update
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy'); // admin.products.destroy
});
// Only authenticated users can add to cart and checkout
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/mpesa', [CheckoutController::class, 'payMpesa'])->name('checkout.mpesa');
    // Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');
});

// Admin routes
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::resource('blogs', MyblogController::class);
    Route::resource('services', App\Http\Controllers\Admin\MyserviceController::class);
    Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class);

  
    
    
    // Products (nested group with all CRUD operations)
    Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'adminIndex'])->name('index'); // admin.products.index
    Route::get('/create', [ProductController::class, 'create'])->name('create'); // admin.products.create
    Route::post('/', [ProductController::class, 'store'])->name('store'); // admin.products.store
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit'); // admin.products.edit
    Route::put('/{product}', [ProductController::class, 'update'])->name('update'); // admin.products.update
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy'); // admin.products.destroy
        
        // You can add more product-related routes here if needed
    });
    
    // Orders
   
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/bulk-actions', [UserController::class, 'bulkActions'])->name('users.bulk-actions');
    Route::post('/users/{user}/impersonate', [UserController::class, 'impersonate'])->name('users.impersonate');
    Route::get('/users/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    Route::get('/admin/users/export', [UserController::class, 'export'])->name('admin.users.export');
    
});
// Route::prefix('admin')->middleware(['auth'])->group(function () {
// Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/cart/data', [CartController::class, 'cartData'])->name('cart.data');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


// });
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('admin.orders.checkout');
    Route::get('user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
      Route::get('/user/orders', [OrderController::class, 'index'])->name('user.orders');
     Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [UserOrderDetailsController::class, 'index'])->name('user.orders');
    Route::get('/orders/{id}', [UserOrderDetailsController::class, 'show'])->name('user.orders.show');
    Route::resource('services', App\Http\Controllers\Admin\MyserviceController::class);
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('service.show');
    Route::get('/admin/services/{id}', [MyserviceController::class, 'show'])->name('admin.services.show');
});


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

Route::post('/mpesa/callback', [MpesaCallbackController::class, 'handle']);

// Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/about', [AboutUsController::class, 'index'])->name('about.index');
    Route::post('/about', [AboutUsController::class, 'update'])->name('about.update');
});

Route::put('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('about/about-services', [AboutServiceController::class, 'index'])->name('admin.about.about-services.index');
    Route::post('about/about-services', [AboutServiceController::class, 'store'])->name('admin.about.about-services.store');
    Route::get('about/about-services/{aboutService}/edit', [AboutServiceController::class, 'edit'])->name('admin.about.about-services.edit');
    Route::put('about/about-services/{aboutService}', [AboutServiceController::class, 'update'])->name('admin.about.about-services.update');
    Route::delete('about/about-services/{aboutService}', [AboutServiceController::class, 'destroy'])->name('admin.about.about-services.destroy');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');
});
Route::get('/{product}', [ShopController::class, 'show'])->name('show');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/admin/place-order', [OrderController::class, 'placeOrder'])->name('admin.order.place');
// Route::get('/admin/delivery', [App\Http\Controllers\Admin\OrderController::class, 'delivery'])->name('admin.orders.delivery');


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('counties', \App\Http\Controllers\Admin\CountyController::class);
    Route::resource('regions', \App\Http\Controllers\Admin\RegionController::class);
});

// Route::resource('admin/locations', \App\Http\Controllers\Admin\LocationController::class)->names('admin.locations');
// Route::get('/order/thank-you', function () {
//     return view('thankyou');
// })->name('orders.thankyou');
// Route::get('/order/receipt/{id}', [OrderController::class, 'showReceipt'])->name('order.receipt');
// // Route::get('/orders/{order}/receipt', [OrderController::class, 'downloadReceipt'])->name('orders.receipt');
// Route::get('/orders/{order}/receipt', [OrderController::class, 'downloadReceipt'])->name('orders.receipt.download');
// Route::post('/admin/place-order', [OrderController::class, 'placeOrder'])->name('admin.place-order');


// Route::get('/order/thank-you', [ThankyouController::class, 'index'])->name('orders.thankyou');
// Route::get('/admin/orders/{order}/receipt/download', [\App\Http\Controllers\Admin\OrderController::class, 'downloadReceipt'])
//     ->name('orders.receipt.download');

// Resource route for admin/locations
Route::resource('admin/locations', LocationController::class)->names('admin.locations');

// Show thank you page (Controller-based route preferred)
Route::get('/order/thank-you', [ThankyouController::class, 'index'])->name('orders.thankyou');

// Show receipt in browser (HTML)
Route::get('/order/receipt/{id}', [OrderController::class, 'showReceipt'])->name('order.receipt');

// Download receipt as PDF (public side)
Route::get('/orders/{order}/receipt', [OrderController::class, 'downloadReceipt'])->name('orders.receipt.download');

// Admin route to place an order (must be POST)
Route::post('/admin/place-order', [AdminOrderController::class, 'placeOrder'])->name('admin.place-order');

// Admin PDF receipt download (if needed)
Route::get('/admin/orders/{order}/receipt/download', [AdminOrderController::class, 'downloadReceipt'])
    ->name('admin.orders.receipt.download');

// Route::middleware(['auth'])->group(function () {
//     Route::get('orders/delivery', [OrderController::class, 'delivery'])->name('orders.delivery');
// });
Route::get('orders/delivery', [App\Http\Controllers\Admin\OrderController::class, 'delivery'])->name('orders.delivery');