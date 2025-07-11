<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'home', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'HomeController@index'                          )->name('page');
});

Route::group(['prefix' => 'member', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'MembersController@index'                          )->name('page');
    Route::get          ('/get',                         'MembersController@get'                            )->name('get');
    Route::post         ('/save',                        'MembersController@save'                           )->name('save');
    Route::get          ('/edit/{id}',                   'MembersController@edit'                           )->name('reason');
    Route::post         ('/close-account',               'MembersController@closeAccount'                   )->name('close');
    Route::post         ('/update/{id}',                 'MembersController@update'                         )->name('update');
    Route::get          ('/destroy/{id}',                'MembersController@destroy'                        )->name('destroy');
    Route::get          ('/destroy-beneficiary/{id}',    'MembersController@destroyBeneficiaries'           )->name('destroy');
    Route::get          ('/get-lookup',                  'MembersController@getMembersList'                 )->name('get');
    Route::post         ('/save-details',                'MembersController@saveDetails'                    )->name('save');
    Route::get          ('/get-details/{id}',            'MembersController@getDetails'                     )->name('save');
});

Route::group(['prefix' => 'capital', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'ShareCapitalController@index'                     )->name('page');
    Route::get          ('/get/{id}',                    'ShareCapitalController@get'                       )->name('get');
    Route::post         ('/save',                        'ShareCapitalController@save'                      )->name('save');
    Route::get          ('/edit/{id}',                   'ShareCapitalController@edit'                      )->name('reason');
    Route::post         ('/update/{id}',                 'ShareCapitalController@update'                    )->name('update');
    Route::get          ('/destroy/{id}',                'ShareCapitalController@destroy'                   )->name('destroy');
});

Route::group(['prefix' => 'savings', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'SavingsDepositController@index'                   )->name('page');
    Route::get          ('/get/{id}',                    'SavingsDepositController@get'                     )->name('get');
    Route::post         ('/save',                        'SavingsDepositController@save'                    )->name('save');
    Route::get          ('/edit/{id}',                   'SavingsDepositController@edit'                    )->name('reason');
    Route::post         ('/update/{id}',                 'SavingsDepositController@update'                  )->name('update');
    Route::get          ('/destroy/{id}',                'SavingsDepositController@destroy'                 )->name('destroy');
});

Route::group(['prefix' => 'loan-request', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'LoanRequestController@index'                      )->name('page');
    Route::get          ('/get',                         'LoanRequestController@get'                        )->name('get');
    Route::post         ('/save',                        'LoanRequestController@save'                       )->name('save');
    Route::get          ('/edit/{id}',                   'LoanRequestController@edit'                       )->name('edit');
    Route::post         ('/update/{id}',                 'LoanRequestController@update'                     )->name('update');
    Route::get          ('/destroy/{id}',                'LoanRequestController@destroy'                    )->name('destroy');
    Route::get          ('/approve/{id}',                'LoanRequestController@approve'                    )->name('approve');
    Route::get          ('/decline/{id}',                'LoanRequestController@decline'                    )->name('decline');
    Route::get          ('/release/{id}',                'LoanRequestController@release'                    )->name('release');
    Route::get          ('/complete/{id}',               'LoanRequestController@complete'                   )->name('complete');
    Route::get          ('/get-details/{id}',            'LoanRequestController@getDetails'                 )->name('get');
    Route::get          ('/get-loan-details/{id}',       'LoanRequestController@getLoanDetails'             )->name('get');
    Route::get          ('/get-schedule/{id}',           'LoanRequestController@getSchedule'                )->name('get');
    Route::post         ('/save-payment',                'LoanRequestController@savePayment'                )->name('save');
    Route::get          ('/destroy-purpose/{id}',        'LoanRequestController@destroyPurpose'             )->name('destroy');
    Route::get          ('/cancel-transaction/{id}',     'LoanRequestController@cancelTransaction'          )->name('destroy');
});

Route::group(['prefix' => 'loan-schedule', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'LoanScheduleController@index'                     )->name('page');
    Route::get          ('/get',                         'LoanScheduleController@get'                       )->name('get');
    Route::post         ('/edit',                        'LoanRequestController@saveEdit'                       )->name('get');
});

Route::group(['prefix' => 'loan-payment', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'LoanPaymentController@index'                      )->name('page');
    Route::get          ('/get',                         'LoanPaymentController@get'                        )->name('get');
    Route::get          ('/edit/{id}',                   'LoanPaymentController@edit'                       )->name('edit');
    Route::post         ('/update/{id}',                 'LoanPaymentController@update'                     )->name('update');
});

Route::group(['prefix' => 'reports', 'middleware' => ['auth']], function (){
    Route::group(['prefix' => 'transaction', 'middleware' => ['auth']], function (){
        Route::get          ('/',                            'TransactionController@index'                  )->name('page');
        Route::get          ('/get',                         'TransactionController@get'                    )->name('get');
    });
});

Route::group(['prefix' => 'setup', 'middleware' => ['auth']], function (){
    Route::group(['prefix' => 'user', 'middleware' => ['auth']], function (){
        Route::get          ('/',                            'UserController@index'                         )->name('page');
        Route::get          ('/get',                         'UserController@get'                           )->name('get');
        Route::post         ('/save',                        'UserController@save'                          )->name('save');
        Route::get          ('/edit/{id}',                   'UserController@edit'                          )->name('edit');
        Route::post         ('/update/{id}',                 'UserController@update'                        )->name('update');
        Route::get          ('/destroy/{id}',                'UserController@destroy'                       )->name('destroy');
    });
    Route::group(['prefix' => 'role', 'middleware' => ['auth']], function (){
        Route::get          ('/',                            'RoleController@index'                         )->name('page');
        Route::get          ('/get',                         'RoleController@get'                           )->name('get');
        Route::post         ('/save',                        'RoleController@save'                          )->name('save');
        Route::get          ('/edit/{id}',                   'RoleController@edit'                          )->name('edit');
        Route::post         ('/update/{id}',                 'RoleController@update'                        )->name('update');
        Route::get          ('/destroy/{id}',                'RoleController@destroy'                       )->name('destroy');
    });
});

Route::group(['prefix' => 'expense', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'ExpenseController@index'                         )->name('page');
    Route::get          ('/get',                         'ExpenseController@get'                           )->name('get');
    Route::post         ('/save',                        'ExpenseController@save'                          )->name('save');
    Route::get          ('/edit/{id}',                   'ExpenseController@edit'                          )->name('edit');
    Route::post         ('/update/{id}',                 'ExpenseController@update'                        )->name('update');
    Route::get          ('/destroy/{id}',                'ExpenseController@destroy'                       )->name('destroy');
});

Route::group(['prefix' => 'damayan_expense', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'DamayanFundExpenseController@index'              )->name('page');
    Route::get          ('/get',                         'DamayanFundExpenseController@get'                )->name('get');
    Route::post         ('/save',                        'DamayanFundExpenseController@save'               )->name('save');
    Route::get          ('/edit/{id}',                   'DamayanFundExpenseController@edit'               )->name('edit');
    Route::post         ('/update/{id}',                 'DamayanFundExpenseController@update'             )->name('update');
    Route::get          ('/destroy/{id}',                'DamayanFundExpenseController@destroy'            )->name('destroy');
});

Route::group(['prefix' => 'damayan_fund', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'DamayanFundController@index'                     )->name('page');
    Route::get          ('/get',                         'DamayanFundController@get'                       )->name('get');
    Route::post         ('/save',                        'DamayanFundController@save'                      )->name('save');
    Route::get          ('/edit/{id}',                   'DamayanFundController@edit'                      )->name('edit');
    Route::post         ('/update/{id}',                 'DamayanFundController@update'                    )->name('update');
    Route::get          ('/destroy/{id}',                'DamayanFundController@destroy'                   )->name('destroy');
});

Route::group(['prefix' => 'loan-type', 'middleware' => ['auth']], function (){
    Route::get          ('/',                            'InterestTypeController@index'                    )->name('page');
    Route::get          ('/get',                         'InterestTypeController@get'                      )->name('get');
    Route::post         ('/save',                        'InterestTypeController@save'                     )->name('save');
    Route::get          ('/edit/{id}',                   'InterestTypeController@edit'                     )->name('edit');
    Route::post         ('/update/{id}',                 'InterestTypeController@update'                   )->name('update');
    Route::get          ('/destroy/{id}',                'InterestTypeController@destroy'                  )->name('destroy');
});