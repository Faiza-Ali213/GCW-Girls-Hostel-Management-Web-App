<?php

use App\Http\Controllers\StaffController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoomAllocationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Main Website Routes
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
| Admin Routes (Dashboard Pages)
|--------------------------------------------------------------------------
*/
// Dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Student Management - MAIN ROUTES ✅
Route::get('/student-records', [StudentController::class, 'index'])->name('student-records');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show');
Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
Route::get('/student/export', [StudentController::class, 'export'])->name('student.export');
Route::get('/student/by-room/{roomNumber}', [StudentController::class, 'getByRoom'])->name('student.by-room');

// Staff Records (Main Page)
Route::get('/staff-records', [PageController::class, 'staff_records'])->name('staff_records');

// Visitors Records - FIXED: Added both spellings to handle blade error
Route::get('/visitors-records', [PageController::class, 'visitors_records'])->name('visitors_records');
// ✅ Added alternative spelling to fix blade error
Route::get('/vistors-records', [PageController::class, 'visitors_records'])->name('vistors_records');

// Notifications
Route::get('/Notification', [PageController::class, 'Notification'])->name('Notification');

/*
|--------------------------------------------------------------------------
| Staff Management Routes (CRUD)
|--------------------------------------------------------------------------
*/
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
Route::get('/staff-search', [StaffController::class, 'search'])->name('staff.search');

/*
|--------------------------------------------------------------------------
| Complaint Management Routes ✅ (FIXED - Added both spellings)
|--------------------------------------------------------------------------
*/
// Complaint Routes - Fixed with both spellings
Route::get('/complaint-request', [ComplaintController::class, 'index'])->name('complaint_request');
// ✅ Added alternative spelling to fix blade error (Capital C)
Route::get('/Complain-request', [ComplaintController::class, 'index'])->name('Complain_request');

Route::get('/complaint-management', [ComplaintController::class, 'index'])->name('complaint_management');
Route::get('/complaint/create', [ComplaintController::class, 'create'])->name('complaint.create');
Route::post('/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
Route::get('/complaint/{id}/edit', [ComplaintController::class, 'edit'])->name('complaint.edit');
Route::put('/complaint/{id}', [ComplaintController::class, 'update'])->name('complaint.update');
Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy'])->name('complaint.destroy');

// Resource Route for Complaints
Route::resource('complaints', ComplaintController::class);

/*
|--------------------------------------------------------------------------
| Visitor Management Routes (CRUD) ✅ ADDED
|--------------------------------------------------------------------------
*/
// Visitor Records Main Page
Route::get('/visitors-records', [VisitorController::class, 'index'])->name('visitors_records');
// ✅ Added alternative spelling to fix blade error
Route::get('/vistors-records', [VisitorController::class, 'index'])->name('vistors_records');

// Visitor CRUD Routes
Route::get('/visitor/create', [VisitorController::class, 'create'])->name('visitor.create');
Route::post('/visitor', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/visitor/{id}', [VisitorController::class, 'show'])->name('visitor.show');
Route::get('/visitor/{id}/edit', [VisitorController::class, 'edit'])->name('visitor.edit');
Route::put('/visitor/{id}', [VisitorController::class, 'update'])->name('visitor.update');
Route::delete('/visitor/{id}', [VisitorController::class, 'destroy'])->name('visitor.destroy');
Route::get('/visitor/search', [VisitorController::class, 'search'])->name('visitor.search');
Route::get('/visitor/export', [VisitorController::class, 'export'])->name('visitor.export');

/*
|--------------------------------------------------------------------------
| Room Allocation Routes ✅ (FIXED)
|--------------------------------------------------------------------------
*/
// Room Allocation Main Page
Route::get('/room-allocation', [RoomAllocationController::class, 'index'])->name('Room_allocation');

// ✅ FIXED: Added dot (.) after name
Route::prefix('room-allocations')->name('room-allocations.')->group(function () {
    // Main index page
    Route::get('/', [RoomAllocationController::class, 'index'])->name('index');
    
    // Search functionality (AJAX)
    Route::get('/search', [RoomAllocationController::class, 'search'])->name('search');
    
    // Get room data for dashboard/stats
    Route::get('/data', [RoomAllocationController::class, 'getRoomData'])->name('data');
    
    // Get available students for dropdown
    Route::get('/available-students', [RoomAllocationController::class, 'getAvailableStudents'])->name('available-students');
    
    // Store new allocation
    Route::post('/', [RoomAllocationController::class, 'store'])->name('store');
    
    // Deallocate student from room
    Route::patch('/{id}/deallocate', [RoomAllocationController::class, 'deallocate'])->name('deallocate');
    
    // Update allocation
    Route::put('/{id}', [RoomAllocationController::class, 'update'])->name('update');
    
    // Delete allocation
    Route::delete('/{id}', [RoomAllocationController::class, 'destroy'])->name('destroy');
});

// Room Allocation Details (if needed separately)
Route::get('/room-allocation-details', [RoomAllocationController::class, 'index'])->name('room_allocation_details');

/*
|--------------------------------------------------------------------------
| Room Management Routes (Admin Panel - Fixed)
|--------------------------------------------------------------------------
*/
// ✅ FIXED: Changed to RoomController and added dot (.) after name
Route::prefix('admin/rooms')->name('admin.rooms.')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('index');
    Route::post('/', [RoomController::class, 'store'])->name('store');
    Route::put('/{id}', [RoomController::class, 'update'])->name('update');
    Route::delete('/{id}', [RoomController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Fee Record Routes
|--------------------------------------------------------------------------
*/
Route::get('/fee-record', [PageController::class, 'fee_record'])->name('fee_record');

/*
|--------------------------------------------------------------------------
| Additional Routes (If any)
|--------------------------------------------------------------------------
*/
// Add any additional routes here