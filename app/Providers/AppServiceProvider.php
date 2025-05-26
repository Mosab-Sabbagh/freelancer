<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Project;         
use App\Policies\ProjectPolicy; 
class AppServiceProvider extends ServiceProvider
{
    /**
     * سياسات التطبيق (Policies).
     *
     * @var array
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,  
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
        // $this->registerPolicies();
    }
}
