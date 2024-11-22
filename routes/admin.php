<?php

use App\Http\Livewire\Admin\Index;

use App\Http\Livewire\Admin\Comments\AdminsReplys;
use App\Http\Livewire\Admin\Comments\All as CommentsAll;
use App\Http\Livewire\Admin\Comments\Edit as CommentsEdit;

use App\Http\Livewire\Admin\Presidency\Admins\All as AdminsAll;
use App\Http\Livewire\Admin\Presidency\Admins\Permissions as AdminsPermissions;

use App\Http\Livewire\Admin\Presidency\Permissions\All as PermissionsAll;
use App\Http\Livewire\Admin\Presidency\Permissions\Create as PermissionsCreate;
use App\Http\Livewire\Admin\Presidency\Permissions\Edit as PermissionsEdit;

use App\Http\Livewire\Admin\Products\All as ProductsAll;
use App\Http\Livewire\Admin\Products\Create as ProductsCreate;
use App\Http\Livewire\Admin\Products\Edit as ProductsEdit;
use App\Http\Livewire\Admin\Products\Single as ProductSingle;

use App\Http\Livewire\Admin\Users\All;
use App\Http\Livewire\Admin\Users\Create;
use App\Http\Livewire\Admin\Users\Edit;
use Illuminate\Support\Facades\Route;


Route::get('/', Index::class);


Route::prefix('users')->name('users.')->group(function () {

    Route::get('/', All::class)->name('all')->can('view-users');
    Route::get('/create', Create::class)->name('create')->can('create-users');
    Route::get('/edit/{user}', Edit::class)->name('edit')->can('edit-users');

});


Route::prefix('products')->name('products.')->group(function () {

    Route::get('/', ProductsAll::class)->name('all')->can('view-products');
    Route::get('/create', ProductsCreate::class)->name('create')->can('create-products');
    Route::get('/edit/{product}', ProductsEdit::class)->name('edit')->can('edit-products');
    Route::get('/single/{product}', ProductSingle::class)->name('single');

});

Route::middleware('super.user')->prefix('Presidency')->name('presidency.')->group(function () {

    Route::get('/admins', AdminsAll::class)->name('admins.all');
    Route::get('/admins/{admin}/permissions', AdminsPermissions::class)->name('admins.permissions');

    Route::get('/permissions', PermissionsAll::class)->name('permissions.all');
    Route::get('/permissions/create', PermissionsCreate::class)->name('permissions.create');
    Route::get('/permissions/edit/{permission}', PermissionsEdit::class)->name('permissions.edit');

});

Route::prefix('comments')->name('comments.')->group(function () {

    Route::get('/', CommentsAll::class)->name('all')->can('view-comments');
    Route::get('/admins-replys', AdminsReplys::class)->name('admins-replys')->can('view-admins-replys');

});