<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Token;
use App\Http\Livewire\Frontend\Index;
use App\Http\Livewire\Frontend\Products;
use App\Http\Livewire\Frontend\Profile;
use App\Http\Livewire\Frontend\SingleProduct;
use Illuminate\Support\Facades\Route;

//////////////////////////////////////////// Auth ////////////////////////////////////////////

Route::middleware('guest')->prefix('auth')->name('auth.')->group(function () {

    Route::get('register' , Register::class)->name('register');
    Route::get('login' , Login::class)->name('login');
    Route::get('token' , Token::class)->name('phone.token');

});

//////////////////////////////////////////// Frontend ////////////////////////////////////////////

Route::get('/', Index::class)->name('home');
Route::get('/profile', Profile::class)->name('profile')->middleware('auth');
Route::get('/machineries', Products::class)->name('machineries');
Route::get('/machineries/{product}/details', SingleProduct::class)->name('machinery.details');

Route::get('/l', function(){
    auth()->loginUsingId(1);
});