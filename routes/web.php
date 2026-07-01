<?php

use App\Http\Controllers\StaffController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ComplaintController;
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

// Student Management
Route::get('/student-records', [PageController::class, 'student_records'])->name('student_records');
Route::get('/student-records/create', [PageController::class, 'student_records_create'])->name('student_records_create');
Route::get('/student-records/{id}/edit', [PageController::class, 'student_records_edit'])->name('student_records_edit');

// Room Allocation
Route::get('/room-allocation', [PageController::class, 'room_allocation'])->name('room_allocation');
Route::get('/room-allocation', [PageController::class, 'room_allocation'])->name('Room_allocation');

// Fee Record
Route::get('/fee-record', [PageController::class, 'fee_record'])->name('fee_record');

// Staff Records (Main Page)
Route::get('/staff-records', [PageController::class, 'staff_records'])->name('staff_records');

// Visitors Records
Route::get('/visitors-records', [PageController::class, 'visitors_records'])->name('visitors_records');
Route::get('/visitors-records', [PageController::class, 'visitors_records'])->name('vistors_records');

// Notifications ✅ YEH ROUTE ADD KAREN
Route::get('/notification', [PageController::class, 'notification'])->name('notification');
Route::get('/notification', [PageController::class, 'notification'])->name('Notification'); // Capital 'N' wala bhi

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
| Complaint Management Routes
|--------------------------------------------------------------------------
*/
// Complaint Request Routes
Route::get('/complaint-request', [ComplaintController::class, 'index'])->name('complaint_request');
Route::get('/complaint-request', [ComplaintController::class, 'index'])->name('Complain_request');

Route::get('/complaint-management', [ComplaintController::class, 'index'])->name('complaint_management');
Route::get('/complaint/create', [ComplaintController::class, 'create'])->name('complaint.create');
Route::post('/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
Route::get('/complaint/{id}/edit', [ComplaintController::class, 'edit'])->name('complaint.edit');
Route::put('/complaint/{id}', [ComplaintController::class, 'update'])->name('complaint.update');
Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy'])->name('complaint.destroy');

// Resource Route for Complaints (Alternative)
Route::resource('complaints', ComplaintController::class);

/*
|--------------------------------------------------------------------------
| Additional Routes (If any)
|--------------------------------------------------------------------------
*/
Route::get('/room-allocation-details', [PageController::class, 'room_allocation_details'])->name('room_allocation_details');