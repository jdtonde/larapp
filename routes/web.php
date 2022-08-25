<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

Route::get('/',[ListingController::class,'index']);

// Renvoi 404 grace à la function qui va rechercher listing dans le model Listing si le id n'existe  pas  



Route::get('/hello', function(){
    return response('<h1>Hello World !</h1>');
});


// requete de notre test api.php

Route::get('search', function(Request $request ){
    return $request->name." ".$request->city;
    // dd($request);
});



//show create Form

Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');


//store listing data
Route::post('/listings', [ListingController::class,'store'])->middleware('auth');

//Manage Listings
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');


//single listing
Route::get('/listings/{id}', [ListingController::class,'show']);


//Edit form
Route::get('/listings/{id}/edit',[ListingController::class,'edit'] )->middleware('auth');

//Update Listing
Route::put('/listings/{id}', [ListingController::class,'update'])->middleware('auth');


//Delete listing
Route::delete('/listings/{id}', [ListingController::class,'destroy'])->middleware('auth');


//Show Register / create User Form
Route::get('/register',[UserController::class, 'create'] )->middleware('guest');

  // Create new User
Route::post('/users',[UserController::class, 'store']);

//log user out

Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');


//show user login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');


//Log in User

Route::post('/users/login',[UserController::class,'authenticate']);



