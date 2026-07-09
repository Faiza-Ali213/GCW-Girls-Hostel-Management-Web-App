<?php

use App\Http\Controllers\StaffController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoomAllocationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\FeeRecordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login, Signup, Logout)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Show login page
    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
    // Handle login form submission
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login.submit');
    
    // Show signup page
    Route::get('/signup', [AuthenticationController::class, 'showSignupForm'])->name('signup');
    // Handle signup form submission
    Route::post('/signup', [AuthenticationController::class, 'signup'])->name('signup.submit');
});

// Authenticated routes (require login)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Main Website Routes (Public)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');
Route::get('/booking', [PageController::class, 'booking'])->name('booking');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    // ============================================
    // Student Management
    // ============================================
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/records', [StudentController::class, 'index'])->name('records');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/', [StudentController::class, 'store'])->name('store');
        Route::get('/{id}', [StudentController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::put('/{id}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('/export', [StudentController::class, 'export'])->name('export');
        Route::get('/by-room/{roomNumber}', [StudentController::class, 'getByRoom'])->name('by-room');
    });

    // ============================================
    // Staff Management
    // ============================================
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/records', [StaffController::class, 'index'])->name('records');
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/', [StaffController::class, 'store'])->name('store');
        Route::get('/{id}', [StaffController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('edit');
        Route::put('/{id}', [StaffController::class, 'update'])->name('update');
        Route::delete('/{id}', [StaffController::class, 'destroy'])->name('destroy');
        Route::get('/search', [StaffController::class, 'search'])->name('search');
    });

    // ============================================
    // Visitor Management
    // ============================================
    Route::prefix('visitor')->name('visitor.')->group(function () {
        Route::get('/records', [VisitorController::class, 'index'])->name('records');
        Route::get('/create', [VisitorController::class, 'create'])->name('create');
        Route::post('/', [VisitorController::class, 'store'])->name('store');
        Route::get('/{id}', [VisitorController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [VisitorController::class, 'edit'])->name('edit');
        Route::put('/{id}', [VisitorController::class, 'update'])->name('update');
        Route::delete('/{id}', [VisitorController::class, 'destroy'])->name('destroy');
        Route::get('/search', [VisitorController::class, 'search'])->name('search');
        Route::get('/export', [VisitorController::class, 'export'])->name('export');
        Route::post('/{id}/check-in', [VisitorController::class, 'checkIn'])->name('check-in');
        Route::post('/{id}/check-out', [VisitorController::class, 'checkOut'])->name('check-out');
    });

    // Alternative spelling for compatibility
    Route::get('/visitors-records', [VisitorController::class, 'index'])->name('visitors_records');
    Route::get('/vistors-records', [VisitorController::class, 'index'])->name('vistors_records');

    // ============================================
    // Complaint Management
    // ============================================
    Route::prefix('complaint')->name('complaint.')->group(function () {
        Route::get('/management', [ComplaintController::class, 'index'])->name('management');
        Route::get('/request', [ComplaintController::class, 'index'])->name('request');
        Route::get('/create', [ComplaintController::class, 'create'])->name('create');
        Route::post('/', [ComplaintController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ComplaintController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ComplaintController::class, 'update'])->name('update');
        Route::delete('/{id}', [ComplaintController::class, 'destroy'])->name('destroy');
    });

    // Alternative spellings for compatibility
    Route::get('/complaint-request', [ComplaintController::class, 'index'])->name('complaint_request');
    Route::get('/Complain-request', [ComplaintController::class, 'index'])->name('Complain_request');
    Route::get('/complaint-management', [ComplaintController::class, 'index'])->name('complaint_management');
    Route::resource('complaints', ComplaintController::class);

    // ============================================
    // Room Allocation
    // ============================================
    Route::prefix('room-allocation')->name('room_allocation.')->group(function () {
        Route::get('/', [RoomAllocationController::class, 'index'])->name('index');
        Route::get('/create', [RoomAllocationController::class, 'create'])->name('create');
        Route::post('/', [RoomAllocationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RoomAllocationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RoomAllocationController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoomAllocationController::class, 'destroy'])->name('destroy');
        Route::delete('/{id}/deallocate', [RoomAllocationController::class, 'deallocate'])->name('deallocate');
        Route::get('/search', [RoomAllocationController::class, 'search'])->name('search');
        Route::get('/available-students', [RoomAllocationController::class, 'getAvailableStudents'])->name('available-students');
        Route::get('/room-data', [RoomAllocationController::class, 'getRoomData'])->name('room-data');
    });

    Route::get('/room_allocation', [RoomAllocationController::class, 'index'])->name('room_allocation');
    Route::resource('room-allocation', RoomAllocationController::class);
    Route::get('/room-allocation-details', [RoomAllocationController::class, 'index'])->name('room_allocation_details');

    // ============================================
    // Room Management
    // ============================================
    Route::prefix('admin/rooms')->name('admin.rooms.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::post('/', [RoomController::class, 'store'])->name('store');
        Route::put('/{id}', [RoomController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoomController::class, 'destroy'])->name('destroy');
    });

    // ============================================
    // Fee Record Management
    // ============================================
    Route::prefix('fee-record')->name('fee-record.')->group(function () {
        Route::get('/', [FeeRecordController::class, 'index'])->name('index');
        Route::get('/create', [FeeRecordController::class, 'create'])->name('create');
        Route::get('/{id}', [FeeRecordController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [FeeRecordController::class, 'edit'])->name('edit');
        Route::post('/', [FeeRecordController::class, 'store'])->name('store');
        Route::put('/{id}', [FeeRecordController::class, 'update'])->name('update');
        Route::delete('/{id}', [FeeRecordController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/status', [FeeRecordController::class, 'updateStatus'])->name('update-status');
        Route::get('/summary', [FeeRecordController::class, 'getSummary'])->name('summary');
    });

    Route::get('/fee_record', [FeeRecordController::class, 'index'])->name('fee_record');
    Route::get('/fee-records', [FeeRecordController::class, 'index'])->name('fee-records.index');

    // ============================================
    // Notification Management
    // ============================================
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/create', [NotificationController::class, 'create'])->name('create');
        Route::post('/', [NotificationController::class, 'store'])->name('store');
        Route::get('/{notification}', [NotificationController::class, 'show'])->name('show');
        Route::get('/{notification}/edit', [NotificationController::class, 'edit'])->name('edit');
        Route::put('/{notification}', [NotificationController::class, 'update'])->name('update');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
        Route::post('/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
        Route::post('/{notification}/mark-as-unread', [NotificationController::class, 'markAsUnread'])->name('mark-as-unread');
        Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-as-read');
        Route::delete('/clear-all', [NotificationController::class, 'clearAll'])->name('clear-all');
        Route::get('/unread-count', [NotificationController::class, 'getUnreadCount'])->name('unread-count');
        Route::get('/latest', [NotificationController::class, 'getLatest'])->name('latest');
    });

    // Alternative spelling
    Route::get('/Notification', [NotificationController::class, 'index'])->name('Notification');
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
});

/*
|--------------------------------------------------------------------------
| Fallback Route (Optional)
|--------------------------------------------------------------------------
*/
// Route::fallback(function () {
//     return redirect('/');
// });