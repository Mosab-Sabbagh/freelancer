<?php

namespace App\Providers;

use App\Models\Chat\Chat;
use App\Models\JobPost;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Broadcast;
use App\Models\Project;
use App\Policies\JobPostPolicy;
use App\Policies\ProjectPolicy;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * (Policies).
     *
     * @var array
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,  
        JobPost::class => JobPostPolicy::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        
        // تعريف مسارات البث مع middleware المصادقة
        Broadcast::routes(['middleware' => ['web', 'auth']]);
        
        // تسجيل سياسات التطبيق
        $this->registerPolicies(); 
    }

    protected function registerPolicies()
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
