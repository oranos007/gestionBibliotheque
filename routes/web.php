<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

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

// Authentication Routes
Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/reports/books', [ReportController::class, 'books'])
         ->name('reports.books');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/reports/books', [ReportController::class, 'books'])
         ->name('reports.books');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Book Routes
    Route::resource('books', BookController::class)->except(['show']);
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
    
    // Borrow Routes
    Route::get('borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::post('borrows/{book}', [BorrowController::class, 'borrow'])->name('borrows.borrow');
    Route::patch('borrows/{borrow}/return', [BorrowController::class, 'return'])->name('borrows.return');
    
    // Admin Only Routes
    Route::middleware(['admin'])->group(function () {


    
        // Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
        //     Route::get('/reports/books', [\App\Http\Controllers\Admin\ReportController::class, 'books'])
        //          ->name('admin.reports.books');
        // });

        Route::prefix('admin')->group(function() {
            Route::get('/reports/books', [\App\Http\Controllers\Admin\ReportController::class, 'books']);
        });


        // Member Routes
        Route::resource('members', MemberController::class);
        
        // Report Routes
        Route::prefix('reports')->group(function () {
            Route::get('books', [ReportController::class, 'books'])->name('reports.books');
            Route::get('members', [ReportController::class, 'members'])->name('reports.members');
            Route::get('overdue', [ReportController::class, 'overdue'])->name('reports.overdue');
        });
        
        Route::get('borrows/history', [BorrowController::class, 'history'])->name('borrows.history');
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
