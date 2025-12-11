<?php

use App\Models\Book;
use App\Models\Category;
use GuzzleHttp\Middleware;
use App\Http\Middleware\admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BorrowRecordController;

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


Route::middleware('auth')->group(function () {

    //route for home page
    Route::get('/',[BookController::class,'home'])->name('home');

    //route for menu page
    Route::get('/menu',[BookController::class,'menu'])->name('menu');

    //route for book searching
    Route::get("/search",[BookController::class,"searchBook"])->name("search");

    //route to access management page
    Route::get("/manage",function(){
        if(Gate::allows("accessManagement"))
        {
            return view('management/home');
        }
        else{
            return redirect()->route('home')->with('error','You are not authorized to access this page.');
        }
    })->name("manage.home");

    //route for user management
    Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware("can:viewAny,App\Models\User");
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware("can:create,App\Models\User");
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware("can:create,App\Models\User");
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware("can:update,App\Models\User");
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware("can:update,App\Models\User");
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    //route for author and category management
    Route::get('/author', [AuthorController::class, 'index'])->name('author.index')->middleware("can:viewAny,App\Models\Author");
    Route::post('/author', [AuthorController::class, 'store'])->name('author.store')->middleware("can:create,App\Models\Author");
    Route::get('/author/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit')->middleware("can:update,App\Models\Author");
    Route::put('/author/update/{id}', [AuthorController::class, 'update'])->name('author.update')->middleware("can:update,App\Models\Author");
    Route::delete('/author/delete/{id}', [AuthorController::class, 'destroy'])->name('author.delete')->middleware("can:delete,App\Models\Author");

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index')->middleware("can:viewAny,App\Models\Category");
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware("can:create,App\Models\Category");
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store')->middleware("can:create,App\Models\Category");
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware("can:update,App\Models\Category");
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware("can:update,App\Models\Category");
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete')->middleware("can:delete,App\Models\Category");

    //route for book management
    Route::get('/book', [BookController::class, 'index'])->name('book.index')->middleware("can:viewAny,App\Models\Book");
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create')->middleware("can:create,App\Models\Book");
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store')->middleware("can:create,App\Models\Book");
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit')->middleware("can:update,App\Models\Book");
    Route::get('/book/show/{id}', [BookController::class, 'show'])->name('book.show')->middleware("can:view,App\Models\Book");
    Route::put('/book/update/{id}', [BookController::class, 'update'])->name('book.update')->middleware("can:update,App\Models\Book");
    Route::delete('/book/delete/{id}', [BookController::class, 'destroy'])->name('book.delete')->middleware("can:delete,App\Models\Book");

    //route for borrow record management
    Route::get("borrrowRecord/borrowRequest/{id}", [BorrowRecordController::class, 'borrowRequest'])->name('borrowRequest');
    Route::delete("/borrowRecord/delete/{id}", [BorrowRecordController::class, 'destroy'])->name('borrowRecord.cancelRequest');
    
    Route::middleware("can:approve_borrow_and_return_book,App\Models\BorrowRecord")->group(function () {
        Route::get('/borrowRecord/approveRequest/{id}', [BorrowRecordController::class, 'approveRequest'])->name('approveRequest');
        Route::get('borrowRecord/returnBook/{id}', [BorrowRecordController::class, 'returnBook'])->name('returnBook');
    });
    Route::middleware("can:viewAny,App\Models\BorrowRecord")->group(function () {
        Route::get("borrowRecord/requesting", [BorrowRecordController::class, 'requesting'])->name('borrowRecord.requesting');
        Route::get("borrowRecord/borrowing", [BorrowRecordController::class, 'borrowing'])->name('borrowRecord.borrowing');
        Route::get("borrowRecord/returned", [BorrowRecordController::class, 'returned'])->name('borrowRecord.returned');
        Route::get("borrowRecord/overdue", [BorrowRecordController::class, 'overdue'])->name('borrowRecord.overdue');
    });
    
    // Route::get("/viewHistory/{id}", [BorrowRecordController::class, 'getBorrowHistory'])->name('viewBorrowHistory.book');
    // Route::get("/viewHistory/{id}", [BorrowRecordController::class, 'getBorrowHistory'])->name('viewBorrowHistory.book');

    Route::get("/viewBorrowHistory",[BorrowRecordController::class,"show"])->name("viewBorrowHistory");

    Route::get("/role",[RoleController::class,'index'])->name('role.index')->middleware("can:viewAny,App\Models\Role");
    Route::get("/role/create",[RoleController::class,'create'])->name('role.create')->middleware("can:create,App\Models\Role");
    Route::post("/role/store",[RoleController::class,'store'])->name('role.store')->middleware("can:create,App\Models\Role");
    Route::get("/role/edit/{id}",[RoleController::class,'edit'])->name('role.edit');
    Route::put("/role/update/{id}",[RoleController::class,'update'])->name('role.update');
    Route::delete("/role/delete/{id}",[RoleController::class,'destroy'])->name('role.delete')->middleware("can:delete,App\Models\Role");

    Route::get("/permission",[PermissionController::class,'index'])->name('permission.index')->middleware("can:viewAny,App\Models\Permission");

    Route::get('/penalty/{status}', [PenaltyController::class, 'show'])->name('penalty.show')->middleware("can:viewAny,App\Models\Penalty");

    Route::middleware("can:payPenalty,App\Models\Penalty")->group(function () {
        Route::get("/payPenalty/{id}", [PenaltyController::class, 'payPenalty'])->name('penalty.pay');
        Route::post("/penalty/{id}",[PenaltyController::class,'update'])->name('penalty.update');
    });


});



require __DIR__.'/auth.php';
