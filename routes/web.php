<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\SchedulingComparisonController;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

    // Notification Routes
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/unread', [NotificationController::class, 'unread'])->name('unread');
        Route::post('/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('mark-read');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::get('/settings', [NotificationController::class, 'settings'])->name('settings');
        Route::put('/settings', [NotificationController::class, 'updateSettings'])->name('settings.update');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // User Management
        Route::resource('users', UserController::class);
        Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

        // Doctor Management
        Route::resource('doctors', DoctorController::class);
        Route::get('/doctors/{doctor}/schedule', [DoctorController::class, 'schedule'])->name('doctors.schedule');
        Route::post('/doctors/{doctor}/schedule', [DoctorController::class, 'updateSchedule'])->name('doctors.schedule.update');
        Route::post('/doctors/{doctor}/toggle-status', [DoctorController::class, 'toggleStatus'])->name('doctors.toggle-status');

        // Patient Management
        Route::resource('patients', PatientController::class);
        Route::get('/patients/{patient}/appointments', [PatientController::class, 'appointments'])->name('patients.appointments');
        Route::get('/patients/{patient}/medical-history', [PatientController::class, 'medicalHistory'])->name('patients.medical-history');

        // Appointment Management
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
        Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
        Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

        // Scheduling Management
        Route::prefix('scheduling')->name('scheduling.')->group(function () {
            Route::get('/', [SchedulingController::class, 'index'])->name('index');
            Route::get('/calendar', [SchedulingController::class, 'calendar'])->name('calendar');
            Route::get('/conflicts', [SchedulingController::class, 'conflicts'])->name('conflicts');
            Route::post('/resolve-conflict/{appointment}', [SchedulingController::class, 'resolveConflict'])->name('resolve-conflict');
            Route::get('/settings', [SchedulingController::class, 'settings'])->name('settings');
            Route::put('/settings', [SchedulingController::class, 'updateSettings'])->name('settings.update');
        });

        // Scheduling Comparison Routes
        Route::prefix('comparison')->name('comparison.')->group(function () {
            Route::get('/dashboard', [SchedulingComparisonController::class, 'dashboard'])->name('dashboard');
            Route::get('/performance', [SchedulingComparisonController::class, 'performance'])->name('performance');
            Route::get('/detailed-analysis', [SchedulingComparisonController::class, 'detailedAnalysis'])->name('detailed-analysis');
            Route::post('/run-comparison', [SchedulingComparisonController::class, 'runComparison'])->name('run-comparison');
            Route::get('/export-data', [SchedulingComparisonController::class, 'exportData'])->name('export-data');
        });

        // Metrics & Analytics
        Route::prefix('metrics')->name('metrics.')->group(function () {
            Route::get('/overview', [MetricsController::class, 'overview'])->name('overview');
            Route::get('/algorithms', [MetricsController::class, 'algorithms'])->name('algorithms');
            Route::get('/performance', [MetricsController::class, 'performance'])->name('performance');
            Route::get('/real-time', [MetricsController::class, 'realTime'])->name('real-time');
            Route::post('/benchmark', [MetricsController::class, 'runBenchmark'])->name('benchmark');
        });

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::get('/appointments', [ReportController::class, 'appointments'])->name('appointments');
            Route::get('/doctors', [ReportController::class, 'doctors'])->name('doctors');
            Route::get('/patients', [ReportController::class, 'patients'])->name('patients');
            Route::get('/scheduling-performance', [ReportController::class, 'schedulingPerformance'])->name('scheduling-performance');
            Route::get('/algorithm-comparison', [ReportController::class, 'algorithmComparison'])->name('algorithm-comparison');
            Route::post('/generate', [ReportController::class, 'generate'])->name('generate');
            Route::get('/export/{type}', [ReportController::class, 'export'])->name('export');
        });

        // System Settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
        Route::get('/system-info', [AdminController::class, 'systemInfo'])->name('system-info');
    });

    // Doctor Routes
    Route::middleware(['role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/dashboard', [DoctorController::class, 'doctorDashboard'])->name('dashboard');

        // Schedule Management
        Route::get('/schedule', [DoctorController::class, 'mySchedule'])->name('schedule');
        Route::post('/schedule', [DoctorController::class, 'updateMySchedule'])->name('schedule.update');
        Route::get('/availability', [DoctorController::class, 'availability'])->name('availability');
        Route::post('/availability', [DoctorController::class, 'updateAvailability'])->name('availability.update');

        // Appointment Management
        Route::get('/appointments', [DoctorController::class, 'myAppointments'])->name('appointments');
        Route::get('/appointments/today', [DoctorController::class, 'todayAppointments'])->name('appointments.today');
        Route::get('/appointments/upcoming', [DoctorController::class, 'upcomingAppointments'])->name('appointments.upcoming');
        Route::get('/appointments/{appointment}', [DoctorController::class, 'showAppointment'])->name('appointments.show');
        Route::post('/appointments/{appointment}/complete', [DoctorController::class, 'completeAppointment'])->name('appointments.complete');
        Route::post('/appointments/{appointment}/reschedule', [DoctorController::class, 'rescheduleAppointment'])->name('appointments.reschedule');
        Route::post('/appointments/{appointment}/cancel', [DoctorController::class, 'cancelAppointment'])->name('appointments.cancel');

        // Patient Management
        Route::get('/patients', [DoctorController::class, 'myPatients'])->name('patients');
        Route::get('/patients/{patient}', [DoctorController::class, 'showPatient'])->name('patients.show');
        Route::post('/patients/{patient}/add-notes', [DoctorController::class, 'addPatientNotes'])->name('patients.add-notes');

        // Performance Metrics
        Route::get('/performance', [DoctorController::class, 'performance'])->name('performance');
        Route::get('/scheduling-analytics', [DoctorController::class, 'schedulingAnalytics'])->name('scheduling-analytics');
    });

    // Patient Routes
    Route::middleware(['role:patient'])->prefix('patient')->name('patient.')->group(function () {
        Route::get('/dashboard', [PatientController::class, 'patientDashboard'])->name('dashboard');

        // Appointment Booking
        Route::get('/book-appointment', [PatientController::class, 'bookAppointment'])->name('book-appointment');
        Route::post('/book-appointment', [PatientController::class, 'storeAppointment'])->name('book-appointment.store');
        Route::get('/book-appointment/greedy', [PatientController::class, 'bookAppointmentGreedy'])->name('book-appointment.greedy');
        Route::post('/book-appointment/greedy', [PatientController::class, 'storeAppointmentGreedy'])->name('book-appointment.greedy.store');
        Route::get('/book-appointment/ai-based', [PatientController::class, 'bookAppointmentAI'])->name('book-appointment.ai');
        Route::post('/book-appointment/ai-based', [PatientController::class, 'storeAppointmentAI'])->name('book-appointment.ai.store');
        Route::get('/book-appointment/compare', [PatientController::class, 'compareBooking'])->name('book-appointment.compare');
        Route::post('/book-appointment/compare', [PatientController::class, 'storeCompareBooking'])->name('book-appointment.compare.store');

        // Available Slots
        Route::get('/available-slots/{doctor}', [PatientController::class, 'getAvailableSlots'])->name('available-slots');
        Route::get('/available-slots/{doctor}/{date}', [PatientController::class, 'getDaySlots'])->name('day-slots');

        // My Appointments
        Route::get('/appointments', [PatientController::class, 'myAppointments'])->name('appointments');
        Route::get('/appointments/upcoming', [PatientController::class, 'upcomingAppointments'])->name('appointments.upcoming');
        Route::get('/appointments/past', [PatientController::class, 'pastAppointments'])->name('appointments.past');
        Route::get('/appointments/{appointment}', [PatientController::class, 'showMyAppointment'])->name('appointments.show');
        Route::post('/appointments/{appointment}/reschedule', [PatientController::class, 'rescheduleMyAppointment'])->name('appointments.reschedule');
        Route::post('/appointments/{appointment}/cancel', [PatientController::class, 'cancelMyAppointment'])->name('appointments.cancel');

        // Medical History
        Route::get('/medical-history', [PatientController::class, 'myMedicalHistory'])->name('medical-history');
        Route::get('/prescriptions', [PatientController::class, 'myPrescriptions'])->name('prescriptions');

        // Doctors
        Route::get('/doctors', [PatientController::class, 'viewDoctors'])->name('doctors');
        Route::get('/doctors/{doctor}', [PatientController::class, 'showDoctor'])->name('doctors.show');
        Route::get('/doctors/{doctor}/reviews', [PatientController::class, 'doctorReviews'])->name('doctors.reviews');
        Route::post('/doctors/{doctor}/review', [PatientController::class, 'addDoctorReview'])->name('doctors.add-review');
    });

    // Common Scheduling Routes (accessible by all roles)
    Route::prefix('scheduling')->name('scheduling.')->group(function () {
        // AJAX Routes for real-time scheduling
        Route::get('/available-times/{doctor}/{date}', [SchedulingController::class, 'getAvailableTimes'])->name('available-times');
        Route::post('/check-availability', [SchedulingController::class, 'checkAvailability'])->name('check-availability');
        Route::post('/book-slot', [SchedulingController::class, 'bookSlot'])->name('book-slot');
        Route::post('/release-slot', [SchedulingController::class, 'releaseSlot'])->name('release-slot');

        // Algorithm Selection Routes
        Route::post('/book/greedy', [SchedulingController::class, 'bookWithGreedy'])->name('book.greedy');
        Route::post('/book/ai-based', [SchedulingController::class, 'bookWithAI'])->name('book.ai');
        Route::post('/book/compare', [SchedulingController::class, 'bookWithComparison'])->name('book.compare');

        // Reschedule Routes
        Route::post('/reschedule/{appointment}/greedy', [SchedulingController::class, 'rescheduleWithGreedy'])->name('reschedule.greedy');
        Route::post('/reschedule/{appointment}/ai-based', [SchedulingController::class, 'rescheduleWithAI'])->name('reschedule.ai');
        Route::post('/reschedule/{appointment}/compare', [SchedulingController::class, 'rescheduleWithComparison'])->name('reschedule.compare');
    });

    // AJAX Routes for Real-time Updates
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('/notifications/count', [NotificationController::class, 'getUnreadCount'])->name('notifications.count');
        Route::get('/appointments/calendar-data', [AppointmentController::class, 'getCalendarData'])->name('appointments.calendar-data');
        Route::get('/metrics/real-time', [MetricsController::class, 'getRealTimeMetrics'])->name('metrics.real-time');
        Route::get('/scheduling/performance', [SchedulingController::class, 'getPerformanceData'])->name('scheduling.performance');
        Route::post('/scheduling/update-priority', [SchedulingController::class, 'updatePriority'])->name('scheduling.update-priority');
    });
});

// API Documentation Routes (for development)
Route::get('/api/docs', function () {
    return view('api-docs');
})->name('api.docs');

// Fallback Route
Route::fallback(function () {
    return view('errors.404');
});
