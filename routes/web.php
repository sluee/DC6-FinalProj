<?php

use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollItemController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::middleware('can:manage_payroll')->group(function(){


        Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
        Route::post('/positions', [PositionController::class, 'store']);
        Route::put('/positions/{position}', [PositionController::class, 'update']);
        Route::delete('/positions/{position}', [PositionController::class, 'destroy']);


        Route::get('/employees/create',[EmployeeController::class , 'create']);
        Route::post('/employees', [EmployeeController::class, 'store']);
        Route::get('/employees/edit/{employee}',[EmployeeController::class , 'edit']);
        Route::get('/employees/{employee}',[EmployeeController::class,'show'])->name('employee.show');
        Route::post('/employees/toggle/{employee}', [EmployeeController::class, 'toggleActive'])->name('employees.toggle');
        Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

        Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
        Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
        Route::post('/payroll', [PayrollItemController::class, 'store'])->name('payroll.create');
        Route::get('/payroll/{payroll}',[PayrollController::class,'show']);

        Route::get('/cashAdvance', [CashAdvanceController::class, 'index'])->name('cashAdvance.index');
        Route::get('/cashAdvance/create', [CashAdvanceController::class, 'create'])->name('cashAdvance.create');
        Route::post('/cashAdvance',[CashAdvanceController::class, 'store'])->name('cashAdvance.store');


        Route::get('/users',[UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users',[UserController::class, 'store'])->name('user.store');
        Route::get('/users/edit/{user}', [UserController::class, 'edit']);
        Route::put('/users/{user}',[UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
        
    });
    Route::get('/payslip', [PayrollItemController::class, 'showMyPayroll'])->name('payroll.payslip')->middleware('can:read_payslip');
    // Route::get('/payslip/{user}', [PayrollItemController::class, 'showMyPayroll'])->name('payroll.payslip')
});


require __DIR__.'/auth.php';
