<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homepage;
use App\Http\Controllers\PostController;


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

//Route::get('/', function () {
//    return view('welcome');
//});

/* Clasa mustBeLoggedIn contine o functie/metoda (handle) middleware personalizata ca sa routeze catre pagina de autentificare in caz ca utilizatorul nu este logat
deci cand cineva face un request catre o pagina /create-post de ex, routa trece prin middleware */

// route utilizator
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login'); //cand da logout -> am facut redirect
Route::get('/homepage', [Homepage::class, 'homepage'])->middleware('guest'); // pagina principala
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// route blog
Route::middleware('auth')->group(function(){
    Route::get('/create-post', [PostController::class, 'showCreateForm']); //routa cu get atunci cand dam click pe create post in login section
    Route::post('/create-post', [PostController::class, 'storeNewPost']);  //routa cu post atunci cand trimitem ce a completat utilizatorul in baza de date
    Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
    Route::delete('/post/{post}', [PostController::class, 'delete']);
    
});
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post'); //routa pentru update , pe utilizatorul autentificat
Route::put('/post/{post}', [PostController::class, 'actuallyUpdate'])->middleware('can:update,post'); //routa pentru atunci cand se da submit la form-ul updatat

// route profil
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
