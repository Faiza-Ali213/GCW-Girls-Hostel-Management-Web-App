<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ComplaintController;

// Test route
Route::get('/test', function () {
    return "Test page working!";
});

// Main website routes
Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/services', [PageController::class, 'services']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/Rooms', [PageController::class, 'Rooms'])->name('Rooms');
Route::get('/gallery', [PageController::class, 'gallery']);
Route::get('/faq', [PageController::class, 'faq']);
Route::get('/rules', [PageController::class, 'rules']);
Route::get('/booking', [PageController::class, 'booking']);

// Admin routes - CHANGE THIS LINE
Route::get('/complain-request', [ComplaintController::class, 'index'])->name('Complain_request');

// OR you can keep both routes - one for page display and one for CRUD
Route::get('/complaint-management', [ComplaintController::class, 'index'])->name('complaint.management');

// Admin routes
Route::get('/student-records', [PageController::class, 'student_records'])->name('student_records');
Route::get('/room-allocation', [PageController::class, 'Room_allocation'])->name('Room_allocation');
Route::get('/fee-record', [PageController::class, 'fee_record'])->name('fee_record');
Route::get('/staff-records', [PageController::class, 'staff_records'])->name('staff_records');
Route::get('/vistors-records', [PageController::class, 'vistors_records'])->name('vistors_records');
Route::get('/notification', [PageController::class, 'Notification'])->name('Notification');
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Complaint Routes - Resource Controller
Route::resource('complaints', ComplaintController::class);

// Staff Routes
Route::resource('staff', StaffController::class);
Route::get('/staff-search', [StaffController::class, 'search'])->name('staff.search');