<?php

use App\Http\Controllers\{
    AdminController,
    AssessmentController,
    ChecklistController,
    NotificationController,
    HomeController,
    ProfileController,
    UserstoryController,
    Admin\ClassController,
    CreateNotificationController,
    givePermission,
    Admin\UserController,
    AppointmentController,
    CalenderController,
    SettingsController,
};
use Illuminate\Support\Facades\Route;

// Import the auth routes
require __DIR__ . '/auth.php';

// Basic pages with auth middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/', HomeController::class)->name('home');
    Route::get('/calendar', [CalenderController::class, 'index'])->name('calendar');
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store'); // This ensures the route is named
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

// Display the user settings form
Route::get('/settings', [SettingsController::class, 'index'])->name('user.settings');
Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('user.settings.edit');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('user.settings.update');



//Notifications route
Route::middleware(['auth', 'verified'])->prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/{id}', [NotificationController::class, 'showNotification'])->name('notifications.notification');
    Route::get('/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/{id}/mark-as-unread', [NotificationController::class, 'markAsUnread'])->name('notifications.markAsUnread');
});

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes with 'access_admin' ability check
Route::middleware(['can:access_admin'])->prefix('admin')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/index', [AdminController::class, 'index'])->name('admin_panel');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/users/import', [UserController::class, 'import'])->name('admin.users.import'); // CSV import route
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');

        Route::get('/classes', [ClassController::class, 'index'])->name('admin.classes')->middleware(['can:view_class']);
        Route::get('/classes/add', [ClassController::class, 'addClass'])->name('admin.classes.add')->middleware(['can:add_class']);
        Route::post('/classes', [ClassController::class, 'storeClass'])->name('admin.classes.store')->middleware(['can:add_class']);
        Route::get('/classes/{id}/edit', [ClassController::class, 'editClass'])->name('admin.classes.edit')->middleware(['can:edit_class']);
        Route::put('/classes/{id}', [ClassController::class, 'updateClass'])->name('admin.classes.update')->middleware(['can:edit_class']);
        Route::delete('/classes/{id}', [ClassController::class, 'deleteClass'])->name('admin.classes.delete')->middleware(['can:remove_class']);
        Route::get('/classes/{classroomID}/adduser', [ClassController::class, 'UserToClass'])->name('admin.classes.adduser')->middleware(['can:edit_class']);
        Route::post('/classes/adduser/{userID}/{classroomID}', [ClassController::class, 'addUserToClass'])->name('admin.classes.adduser.post')->middleware(['can:edit_class']);
        Route::delete('/classes/removeuser/{userID}/{classroomID}', [ClassController::class, 'removeUserFromClass'])->name('admin.classes.adduser.delete')->middleware(['can:edit_class']);

        Route::post('/admin/users/import', [UserController::class, 'import'])->name('admin.users.import');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    });


});

// Other examples and routes
Route::get('/permission', [givePermission::class, 'show']);
Route::get('/notification', [CreateNotificationController::class, 'index']);

// Assessment, Checklist, and Userstory routes with auth and verified middleware
Route::middleware(['auth', 'verified'])->group(function () {
    // Assessment routes
    Route::prefix('assessment')->group(function () {
        Route::get('/', [AssessmentController::class, 'index'])->name('assessment.index');
        Route::middleware(['can:add_assessment'])->group(function () {
            Route::get('/create', [AssessmentController::class, 'create']);
            Route::post('/store', [AssessmentController::class, 'store']);
        });
        Route::get('/{assessment}', [AssessmentController::class, 'show'])->name('assessment.show');
        Route::middleware(['can:edit_assessment'])->group(function () {
            Route::get('/{assessment}/edit', [AssessmentController::class, 'edit'])->name('assessment.edit');
            Route::put('/{assessment}', [AssessmentController::class, 'update'])->name('assessment.update');
        });
        Route::delete('/{assessment}', [AssessmentController::class, 'destroy'])->middleware('can:delete_assessment')->name('assessment.destroy');
    });

    // Checklist routes
    Route::prefix('checklists')->group(function () {
        Route::get('/', [ChecklistController::class, 'index'])->name('checklists.index');
        Route::middleware(['can:add_checklist'])->group(function () {
            Route::get('/{assessment}/create', [ChecklistController::class, 'create'])->name('assessment.checklists.create');
            Route::post('/', [ChecklistController::class, 'store'])->name('checklists.store');
        });
        Route::get('/{checklist}', [ChecklistController::class, 'show'])->name('checklists.show');
        Route::middleware(['can:edit_checklist'])->group(function () {
            Route::get('/{checklist}/edit', [ChecklistController::class, 'edit'])->name('checklists.edit');
            Route::put('/{checklist}', [ChecklistController::class, 'update'])->name('checklists.update');
        });
        Route::delete('/{checklist}', [ChecklistController::class, 'destroy'])->middleware('can:delete_checklist')->name('checklists.destroy');
    });

    // Userstory routes
    Route::prefix('userstories')->middleware(['can:add_userstory'])->group(function () {
        Route::get('/{checklist}/create', [UserstoryController::class, 'create'])->name('checklists.userstories.create');
        Route::post('/', [UserstoryController::class, 'store'])->name('userstories.store');
    });
    Route::post('/{checklist}/show', [UserstoryController::class, 'saveCompletedUserstories'])->name('userstories.save');
    Route::get('/classroom/{classroom_id}', [ClassController::class, 'show'])->name('classroom.show');
});