<?php

use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagementUserController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WorkspaceController;
use App\Http\Controllers\JobPoster\Campany\CompanyController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobPoster\DadshbordController;
use App\Http\Controllers\JobPoster\JobPosterController;
use App\Http\Controllers\JobPoster\ProjectController;
use App\Http\Controllers\JobSeeker\DashbordSeekerController;
use App\Http\Controllers\JobSeeker\ProfileController;
use App\Http\Controllers\JobSeeker\ProjectBrowseController;
use App\Http\Controllers\JobSeeker\WorkSamplesController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return redirect()->route('home'); 
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

Route::get('/admin/dashbord', [DashboardController::class, 'index'])->middleware(['auth','admin'])->name('admin.dashboard');
Route::get('/jobSeeker/dash', [DashbordSeekerController::class, 'index'])->middleware(['auth','job_seeker'])->name('jobSeeker.dash');;

// start test middleware
// Route::get('/admin/dash', function () {
//     return view('admin.dashboard');
// })->middleware(['auth','admin'])->name('admin.dashboard');


// Route::get('/jobSeeker/dash', function () {
//     return view('jobSeeker.dashbord');
// })->middleware(['auth','job_seeker'])->name('jobSeeker.dash');

Route::get('/supporter/dash', function () {
    return view('supporter.dash');
})->middleware(['auth','supporter'])->name('supporter.dash');

// end test middleware

// middleware job_seeker or admin 
Route::get('jobseeker/info/{id}', [ProfileController::class, 'info'])->name('profile.info');
Route::get('update-password', [ProfileController::class, 'updatePassword'])->middleware(['auth','job_seeker'])->name('profile.update-password');
Route::get('profile/{id}', [ProfileController::class, 'profile'])->middleware(['auth','job_seeker'])->name('profile.show');

// job_seeker profile
Route::middleware(['auth', 'job_seeker'])->prefix('jobseeker')->name('jobSeeker.')->group(function () {
    Route::get('profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
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
        Route::get('/show/{id}', [ManagementUserController::class, 'show'])->name('show');


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


Route::get('worksample', [WorkSamplesController::class, 'add'])->middleware(['auth','job_seeker'])->name('worksample.add');
Route::post('worksample', [WorkSamplesController::class, 'store'])->middleware(['auth','job_seeker'])->name('worksample.store');
Route::get('worksamples', [WorkSamplesController::class, 'index'])->middleware(['auth','job_seeker'])->name('worksample.index');
Route::get('worksample/{id}', [WorkSamplesController::class, 'show'])->middleware(['auth','job_seeker'])->name('worksample.show');
Route::Delete('worksample/{id}', [WorkSamplesController::class, 'destroy'])->middleware(['auth','job_seeker'])->name('worksample.destroy');
Route::get('worksample/edit/{id}', [WorkSamplesController::class, 'edit'])->middleware(['auth','job_seeker'])->name('worksample.edit');
Route::PUT('worksample/{id}', [WorkSamplesController::class, 'update'])->middleware(['auth','job_seeker'])->name('worksample.update');


Route::get('testDash/jobPoster', function () {
    return view('jobPoster.dashbord');
})->name('jobPoster.dashboard');

Route::middleware(['auth', 'job_poster'])->group(function () {
    Route::get('/jobposter/profile/edit', [JobPosterController::class, 'edit'])->name('jobposter.edit');
    Route::post('/jobposter/profile/update/{id}', [JobPosterController::class, 'update'])->name('jobposter.update');
    Route::get('/jobposter/profile/{id}', [JobPosterController::class, 'profile'])->name('jobposter.profile');
});

    Route::get('/jobPoster/dash', [DadshbordController::class, 'index'])->middleware(['auth', 'job_poster'])->name('jobPoster.dash');
    Route::get('jobposter/projects/', [ProjectController::class, 'index'])->middleware(['auth', 'job_poster'])->name('jobposter.projects.index');
    Route::get('jobposter/projects/create', [ProjectController::class, 'create'])->middleware(['auth', 'job_poster'])->name('jobposter.projects.create');
    Route::post('jobposter/projects/store', [ProjectController::class, 'store'])->middleware(['auth', 'job_poster'])->name('jobposter.projects.store');

Route::get('jobseeker/projects', [ProjectBrowseController::class, 'index'])->middleware(['auth', 'job_seeker'])->name('jobseeker.projects.index');
Route::get('/project/details/{id}', [ProjectBrowseController::class, 'details'])->middleware(['auth', 'job_seeker'])->name('project.details');


// Route::get('/jobposter/company/edit', [JobPosterController::class, 'edit'])->name('jobposter.edit');
Route::post('/jobposter/update/{id}', [CompanyController::class, 'update'])->name('company.update');
