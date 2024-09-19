<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\{
    AdminController,
    InvestmentPackageController,
    ReferrelPackageController,
    DashboardPagesController,
    DirectPaymentsController,
    TransactionController,
    PercentageController
};
use App\Http\Controllers\Backend\User\{
    UserController,
    PackagesController,
    WalletController,
    WithdrawController,
    ReferralController,
    PaymentController,
    ContactUsController,
    UserWithdrawController,
};
use App\Enums\UserTypesEnum;
use App\Http\Controllers\Frontend\User\{
    HomeController,
};


// Route::fallback(function () {
//     return redirect()->route('admin.loginPage');
// })->middleware('adminRole:admin');

Route::get('/db', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    return "Success";
});

Route::get('/', [HomeController::class, 'index'])->name('home');
/* admin routes */
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.loginPage');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::group([
    'middleware' => 'adminRole:'.UserTypesEnum::ADMIN,
    'prefix' => UserTypesEnum::ADMIN,
    'as' => UserTypesEnum::ADMIN.'.',
], function () {
    Route::get('/dashboard',                [AdminController::class, 'dashboard'])->name('dashboard');
    Route::Resource('/investment_packages', InvestmentPackageController::class);
    Route::Resource('/referrel_packages', ReferrelPackageController::class);
    Route::Resource('/percentage', PercentageController::class);
    Route::get('/all/users', [UserController::class, 'users'])->name('users');
    Route::get('/users/search', [UserController::class, 'searchUsers'])->name('users.search');
    Route::get('/delete/users', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'update_profile'])->name('update.profile');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('contact/us',[ContactUsController::class, 'index'])->name('contactUs');
    Route::get('contact/us/delete/{id}',[ContactUsController::class, 'destroy'])->name('contactUs.destroy');
    Route::get('total/investments',[DashboardPagesController::class, 'totalInvestments'])->name('totalInvestments');
    Route::get('total/users/profit',[DashboardPagesController::class, 'totalUsersProfit'])->name('totalUsersProfit');
    Route::get('total/referrals',[DashboardPagesController::class, 'totalReferrals'])->name('totalReferrals');
    Route::post('direct/deposit/{id}',[DirectPaymentsController::class, 'deposit'])->name('deposit');
    Route::post('direct/withdraw/{id}',[DirectPaymentsController::class, 'withdraw'])->name('withdraw');
    Route::post('direct/profit/withdraw/{id}',[DirectPaymentsController::class, 'profitWithdraw'])->name('withdrawProfit');
    Route::get('withdraw/pay/{id}',[DirectPaymentsController::class, 'pay'])->name('pay');
    Route::get('withdraw/confirm',[DirectPaymentsController::class, 'directWithdrawPage'])->name('withdrawConfirm');
    Route::get('transactions',[TransactionController::class, 'index'])->name('transactions');

});

/* user routes */
Route::get('/user/signup',  [UserController::class, 'singUpPage'])->name('user.singUpPage');
Route::post('/user/signup', [UserController::class, 'singUp'])->name('user.signup');
Route::get('/user/login',   [UserController::class, 'index'])->name('user.loginPage');
Route::post('/user/login',  [UserController::class, 'login'])->name('user.login');
Route::post('/user/contact/us',[ContactUsController::class,'store'])->name('user.contactUs');

/* refer register*/
Route::get('/register/{id}', [UserController::class, 'referRegister'])->name('user.register');

Route::group([
    'middleware' => 'adminRole:'.UserTypesEnum::USER,
    'prefix' => UserTypesEnum::USER,
    'as' => UserTypesEnum::USER.'.',
], function () {
    Route::get('/dashboard',         [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/packages',          [PackagesController::class, 'index'])->name('packages');
    Route::get('/packages/cancel/{id}',  [PackagesController::class, 'cancel_package'])->name('cancel_package');
    Route::post('/packages/buy', [PackagesController::class, 'buy_package'])->name('buy_package');

    // coinpayment route
    Route::post('/deposit/{id}', [PaymentController::class,'deposit'])->name('deposit');
    Route::get('payment/success',[PaymentController::class,'success'])->name('coin.success');
    Route::get('payment/cancel', [PaymentController::class,'cancel'])->name('coin.cancel');
    Route::get('/payment',[PaymentController::class,'payment'])->name('coin.payment');
    Route::post('/withdraw/{id}',[UserWithdrawController::class, 'index'])->name('withdraw');
    Route::post('/withdraw/profit/{id}',[UserWithdrawController::class, 'profitWithdraw'])->name('withdrawProfit');
    Route::get('/payment/withdraw',[UserWithdrawController::class,'index'])->name('coin.withdraw');

    Route::get('/wallet',            [WalletController::class, 'index'])->name('wallet');
    Route::get('/logout',            [UserController::class, 'logout'])->name('logout');
    // Route::post('/withdraw/{id}',         [WithdrawController::class, 'withdraw'])->name('withdraw');
    Route::get('/withdraw/details',  [WithdrawController::class, 'index'])->name('withdrawDetails');
    Route::get('/profile',           [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update',   [UserController::class, 'update_profile'])->name('update.profile');
    Route::get('referrals',          [ReferralController::class, 'index'])->name('referrals');
    Route::get('/withdraw/fees',[UserWithdrawController::class, 'withdrawFees'])->name('withdrawFees');
});
Route::get('change',          [ReferralController::class, 'convertCurrency'])->name('convertLTCTtoUSD');

Auth::routes();