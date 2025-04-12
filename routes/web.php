<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackAndRatingController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperadminVisitorController;
use App\Http\Controllers\SuperadminEventController;
use App\Http\Controllers\SuperadminNotificationsController;

// ** Public Routes **

// Visitor Registration Form (No login required)
Route::get('/visitor-registration', [VisitorController::class, 'showForm'])->name('visitor_registration');
Route::post('/visitor-registration', [VisitorController::class, 'storePublic'])->name('visitor.store.public');

// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard'); // Correctly closed the closure
    })->name('dashboard');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); // Admin dashboard

        // Visitor management
        Route::prefix('visitors')->name('visitors.')->group(function () {
            Route::get('/', [VisitorController::class, 'index'])->name('index'); // List visitors
            Route::get('/create', [VisitorController::class, 'create'])->name('create'); // Add visitor form
            Route::post('/store', [VisitorController::class, 'store'])->name('store'); // Store new visitor
            Route::get('/{id}/edit', [VisitorController::class, 'edit'])->name('edit'); // Edit visitor
            Route::put('/{id}', [VisitorController::class, 'update'])->name('update'); // Update visitor
            Route::delete('/{id}', [VisitorController::class, 'destroy'])->name('destroy'); // Delete visitor
        });
        // User management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index'); // List all users
            Route::get('/create', [AdminController::class, 'create'])->name('create'); // Show form to add user
            Route::post('/store', [AdminController::class, 'store'])->name('store'); // Save new user
            Route::get('/{id}/edit_user', [AdminController::class, 'edit_user'])->name('edit_user'); // Edit user details
            Route::put('/{id}', [AdminController::class, 'update'])->name('update'); // Update user
            Route::delete('/{id}', [AdminController::class, 'delete'])->name('delete'); // Delete user
        });
        // Event management
        Route::prefix('events')->name('events.')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('index');
            Route::get('/create', [EventController::class, 'create'])->name('create');
            Route::post('/store', [EventController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [EventController::class, 'edit'])->name('edit');
            Route::put('/{id}', [EventController::class, 'update'])->name('update');
            Route::delete('/{id}', [EventController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/feedbacks', [FeedbackAndRatingController::class, 'viewFeedbacks'])->name('feedbacks'); // Fetch feedbacks for an event
        });

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportsController::class, 'generateVisitorReport'])->name('index'); // Display reports
            Route::get('/reports', [ReportsController::class, 'showReportForm'])->name('reports'); ;
            Route::get('/export', [ReportsController::class, 'exportVisitorReport'])->name('export'); // Export reports as CSV
            Route::post('/generate-event-pdf', [ReportsController::class, 'generateEventPdf'])->name('generateEventPDF'); // POST route for generating PDF report
        });

        // Notifications management
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationsController::class, 'index'])->name('index'); // List notifications
            Route::get('/create', [NotificationsController::class, 'create'])->name('create'); // Create notification
            Route::post('/store', [NotificationsController::class, 'store'])->name('store'); // Store notification
            Route::post('/sendEmail', [NotificationsController::class, 'sendEmail'])->name('sendEmail'); // Send email notifications
            Route::get('/email', [NotificationsController::class, 'emailUsers'])->name('email');
            Route::post('/send-email', [NotificationsController::class, 'sendEmail'])->name('send-email');
        });

        // Participation requests
        Route::prefix('participation-requests')->name('participation-requests.')->group(function () {
            Route::get('/', [AdminController::class, 'showParticipationRequests'])->name('requests');
            Route::post('/{id}/approve', [AdminController::class, 'approveParticipationRequest'])->name('approve');
            Route::post('/{id}/reject', [AdminController::class, 'rejectParticipationRequest'])->name('reject');
        });

        Route::get('/participants-list', [AdminController::class, 'listParticipants'])->name('participants-list');
    });

    // User Page Routes
    Route::prefix('user')->name('user.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // Events List
        Route::get('/events', [UserController::class, 'eventsIndex'])->name('event-user'); 
        // Participation History
        Route::get('history', [UserController::class, 'participationHistory'])->name('history'); 
        // Event Participation (store/cancel)
        Route::post('/participation/store', [ParticipationController::class, 'store'])->name('participation.store');
        Route::delete('/participation/{id}', [ParticipationController::class, 'cancel'])->name('participation.cancel');
        // Feedback and Rating
        Route::post('events/{id}/feedback_rating', [FeedbackAndRatingController::class, 'storeFeedback'])->name('events.feedback_rating');
        // Notifications
        Route::get('/notifications', [NotificationsController::class, 'userNotifications'])->name('notifications');
    });
  
    // Super-Admin Routes
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'Dashboard'])->name('dashboard'); // SuperAdmin dashboard
        // Visitor management
        Route::prefix('visitors')->name('visitors.')->group(function () {
            Route::get('/', [SuperadminVisitorController::class, 'index'])->name('index'); // List visitors
            Route::get('/create', [SuperadminVisitorController::class, 'create'])->name('create'); // Add visitor form
            Route::post('/store', [SuperadminVisitorController::class, 'store'])->name('store'); // Store new visitor
            Route::get('/{id}/edit', [SuperadminVisitorController::class, 'edit'])->name('edit'); // Edit visitor
            Route::put('/{id}', [SuperadminVisitorController::class, 'update'])->name('update'); // Update visitor
            Route::delete('/{id}', [SuperadminVisitorController::class, 'destroy'])->name('destroy'); // Delete visitor
        });
        // Event management
        Route::prefix('events')->name('events.')->group(function () {
            Route::get('/', [SuperadminEventController::class, 'index'])->name('index');
            Route::get('/create', [SuperadminEventController::class, 'create'])->name('create');
            Route::post('/store', [SuperadminEventController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SuperadminEventController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SuperadminEventController::class, 'update'])->name('update');
            Route::delete('/{id}', [SuperadminEventController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/feedbacks', [FeedbackAndRatingController::class, 'viewFeedbacks'])->name('feedbacks'); // Fetch feedbacks for an event
        });

        // Notifications management
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [SuperadminNotificationsController::class, 'index'])->name('index'); // List notifications
            Route::get('/create', [SuperadminNotificationsController::class, 'create'])->name('create'); // Create notification
            Route::post('/store', [SuperadminNotificationsController::class, 'store'])->name('store'); // Store notification
        });

        // Participation requests
        Route::prefix('participation-requests')->name('participation-requests.')->group(function () {
            Route::get('/', [SuperAdminController::class, 'showParticipationRequests'])->name('requests'); // Change 'requests' to 'index'
            Route::post('/{id}/approve', [SuperAdminController::class, 'approveParticipationRequest'])->name('approve');
            Route::post('/{id}/reject', [SuperAdminController::class, 'rejectParticipationRequest'])->name('reject');
        });        

        // Participants list
        Route::get('/participants-list', [SuperAdminController::class, 'listParticipants'])->name('participants-list');
        // Export Report Route
        Route::get('/export-report', [SuperAdminController::class, 'exportReport'])->name('exportReport');
        // Refresh Data Route
        Route::get('/refresh-data', [SuperAdminController::class, 'refreshData'])->name('refreshData');
    });
});

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');