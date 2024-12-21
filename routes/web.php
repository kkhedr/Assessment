<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BlogController, AuthController, UserController};

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
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/blogs', BlogController::class)->except('show');
    Route::post('/blogs-import', [BlogController::class, 'import'])->name('blogs.import');
    Route::get('/blogs-export', [BlogController::class, 'export'])->name('blogs.export');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/assign-role', [UserController::class, 'assignRole'])->name('assign.role');
    
});
