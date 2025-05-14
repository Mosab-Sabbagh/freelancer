<?php

use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagementUserController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WorkspaceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return redirect()->route('home'); // أو تقدر تخليه فارغ
})->middleware(['auth', 'role.redirect'])->name('dashboard');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('guest.index');
})->name('home');

Route::get('/admin/dashbord', [DashboardController::class, 'index'])->name('admin.dashboard');

// start test middleware
// Route::get('/admin/dash', function () {
//     return view('admin.dashboard');
// })->middleware(['auth','admin'])->name('admin.dashboard');

Route::get('/jobPoster/dash', function () {
    return view('jobPoster.dash');
})->middleware(['auth','job_poster'])->name('jobPoster.dash');

Route::get('/jobSeeker/dash', function () {
    return view('jobSeeker.dashbord');
})->middleware(['auth','job_seeker'])->name('jobSeeker.dash');

Route::get('/supporter/dash', function () {
    return view('supporter.dash');
})->middleware(['auth','supporter'])->name('supporter.dash');

// end test middleware

// edit profile
Route::middleware(['auth', 'job_seeker'])->prefix('jobseeker')->name('jobSeeker.')->group(function () {
    Route::get('profile', [\App\Http\Controllers\JobSeeker\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [\App\Http\Controllers\JobSeeker\ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware(['auth','admin'])->group(function () {
    Route::prefix('admin/skill')->name('admin.skill.')->group(function () {
        Route::get('/', [SkillController::class, 'index'])->name('index');
        Route::post('/', [SkillController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SkillController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SkillController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SkillController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth','admin'])->group(function () {
    Route::prefix('admin/service')->name('admin.service.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ServiceController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth','admin'])->group(function () {
    Route::prefix('admin/workspace')->name('admin.workspace.')->group(function () {
        Route::get('/', [WorkspaceController::class, 'index'])->name('index');
        Route::post('/', [WorkspaceController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WorkspaceController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [WorkspaceController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [WorkspaceController::class, 'destroy'])->name('destroy');
    });
});


Route::middleware(['auth','admin'])->group(function () {
    Route::prefix('admin/user')->name('admin.user.')->group(function () {
        Route::get('/', [ManagementUserController::class, 'index'])->name('index');
        Route::get('/add', [ManagementUserController::class, 'add'])->name('create');
        Route::post('/', [ManagementUserController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [ManagementUserController::class, 'destroy'])->name('destroy');


        Route::get('/edit/{id}', [ManagementUserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ManagementUserController::class, 'update'])->name('update');
    });
});


Route::middleware(['auth','admin'])->group(function () {
    Route::prefix('admin/campaign')->name('admin.campaign.')->group(function () {
        Route::get('/', [CampaignController::class, 'index'])->name('index');
        Route::get('/add', [CampaignController::class, 'add'])->name('create');
        Route::post('/', [CampaignController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CampaignController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CampaignController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CampaignController::class, 'destroy'])->name('destroy');
    });
});



