<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/loans', 'AdminsController@loansIndex')->name('admin.loans-index');
    Route::get('/loans/{loan}', 'AdminsController@showLoan')->name('admin.loan-show');
    Route::put('/loans/{loan}', 'LoansController@update')->name('loans.update');
    Route::delete('/loans/{loan}/delete', 'LoansController@delete')->name('loans.delete');
    Route::put('/loans/{loan}/archive', 'LoansController@archive')->name('loans.archive');
    Route::post('/loan-payments/{loan}/{promise}', 'LoanPaymentsController@store')->name('loan-payments.store');
    Route::get('/approved-members', 'AdminsController@approvedMembers')->name('admin.approved-members');
    Route::get('/denied-members', 'AdminsController@deniedMembers')->name('admin.denied-members');
    Route::get('/show-member/{member}', 'AdminsController@showMember')->name('admin.show-member');
    Route::post('/share-payment/{member}', 'SharePaymentsController@store')->name('admin.share-payment.store');
    Route::put('/update-member-share/{member}', 'SharesController@store')->name('share.store');
    Route::put('/update-member-info/{member}', 'AdminsController@updateMemberInfo')->name('admins.update-member-info');
    Route::get('/update-member-share-payment/{sharePayment}', 'SharePaymentsController@edit')->name('share-payment.edit');
    Route::put('/update-member-share-payment/{sharePayment}', 'SharePaymentsController@update')->name('share-payment.update');
    Route::put('/{member}/update-photo', 'MembersController@updatePhoto')->name('members.update-photo');
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'AdminAuth\RegisterController@register');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

    Route::get('/dashboard', 'AdminsController@dashboard')->name('admin.dashboard');
    Route::get('/index', 'AdminsController@index')->name('admins.index');
    Route::get('/{admin}', 'AdminsController@show')->name('admin.show');
    Route::get('/review-applicant/{applicant}', 'AdminsController@reviewApplicant')->name('admin.review-applicant');
    Route::put('/applicant/{applicant}', 'ApplicationsController@update')->name('applications.update');
    Route::put('/{admin}', 'AdminsController@update')->name('admin.update');
    Route::put('/change-password/{admin}', 'AdminsController@changePassword')->name('admin.change-password');
    Route::delete('delete/{member}', 'AdminsController@deleteMember')->name('admin.delete-member');
});

Route::group(['prefix' => 'member'], function () {
    Route::get('/login', 'MemberAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'MemberAuth\LoginController@login');
    Route::post('/logout', 'MemberAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'MemberAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'MemberAuth\RegisterController@register');

    Route::post('/password/email', 'MemberAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'MemberAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'MemberAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'MemberAuth\ResetPasswordController@showResetForm');

    Route::get('/profile', 'MembersController@show')->name('members.show');
    Route::get('/loans/apply/{member}', 'LoansController@create')->name('loans.create');
    Route::post('/loans/apply/{member}', 'LoansController@store')->name('loans.store');
    Route::get('/loans/index', 'LoansController@index')->name('loans.index');
    Route::get('/loans/{loan}', 'LoansController@show')->name('loans.show');
    Route::put('/comaker/{comaker}', 'ComakersController@update')->name('comaker.update');
    Route::put('/{member}', 'MembersController@update')->name('members.update');
    Route::put('/change-password/{member}', 'MembersController@changePassword')->name('member.change-password');

    Route::get('/promissory-note/create/{loan}', 'PromissoryNotesController@create')->name('promissory-note.create');
    Route::post('/promises/store/{promissoryNote}', 'PromisesController@store')->name('promises.store');
});