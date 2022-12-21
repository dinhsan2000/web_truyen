<?php

use App\Http\Controllers\admin\AuthorController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\StoryController;
use App\Http\Controllers\admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Artisan;

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
    return view('welcome');
});
Route::prefix('admin')->middleware(Authenticate::class)->group(function () {
    Route::get('/trang-chu', [HomeController::class,'index'])->name('admin.home');

    // The loai
    Route::get('/danh-sach-the-loai', [CategoriesController::class,'index'])->name('admin.category');
    Route::get('/them-the-loai-moi', [CategoriesController::class,'create']);
    Route::post('/them-the-loai-moi', [CategoriesController::class,'store']);
    Route::get('/sua-the-loai/{id}', [CategoriesController::class,'edit'])->name('category_edit');
    Route::post('/sua-the-loai/{id}', [CategoriesController::class,'update']);
    Route::get('/xoa-the-loai/{id}', [CategoriesController::class,'destroy'])->name('category_delete');
    Route::get('/xem-chi-tiet-the-loai/{id}/{slug}',[CategoriesController::class,'show'])->name('category_detail');

    // Tac gia
    Route::get('/danh-sach-tac-gia', [AuthorController::class,'index'])->name('admin.author');
    Route::get('/them-tac-gia-moi', [AuthorController::class,'create']);
    Route::post('/them-tac-gia-moi', [AuthorController::class,'store']);
    Route::get('/sua-tac-gia/{id}', [AuthorController::class,'edit']);
    Route::post('/sua-tac-gia/{id}', [AuthorController::class,'update'])->name('author_edit');
    Route::get('/xoa-tac-gia-moi/{id}', [AuthorController::class,'destroy'])->name('author_delete');
    Route::get('/xem-chi-tiet-tac-gia/{id}', [AuthorController::class,'show'])->name('author_detail');

    // Danh sach truyen
    Route::get('/danh-sach-truyen', [StoryController::class,'index'])->name('admin.story');
    Route::get('/them-truyen-moi', [StoryController::class,'create']);
    Route::post('/them-truyen-moi', [StoryController::class,'store']);
    Route::get('/sua-truyen/{id}', [StoryController::class,'edit']);
    Route::post('/sua-truyen/{id}', [StoryController::class,'update'])->name('story_edit');
    Route::get('/xoa-truyen/{id}', [StoryController::class,'destroy'])->name('story_delete');
    Route::get('/xem-chi-tiet-truyen/{id}', [StoryController::class,'show'])->name('story_detail');
});
Route::prefix('admin')->group(function () {
    Route::get('/dang-ki', [AuthController::class, 'register'])->name('admin.register');
    Route::post('/dang-ki', [AuthController::class, 'postRegister']);
    Route::get('/dang-nhap', [AuthController::class, 'login'])->name('login');
    Route::post('/dang-nhap', [AuthController::class, 'postLogin']);
    Route::get('/dang-xuat', [AuthController::class, 'signOut']);
});

Route::group(['prefix' => 'admin/laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
