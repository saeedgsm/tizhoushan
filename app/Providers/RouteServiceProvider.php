<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        // General Routes
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        // Admin Routes
        Route::middleware(['web','auth','checkAdmin'])
            ->prefix('admin')
            ->name('admin.')
            ->namespace($this->namespace.'\\Admin')
            ->group(base_path('routes/admin.php'));

        Route::namespace($this->namespace.'\\Admin\Api')
            ->prefix('api/admin')
            ->group(base_path('routes/adminApi.php'));

        // Teacher Routes
        Route::middleware(['web','auth','checkTeacher'])
            ->prefix('teacher')
            ->name('teacher.')
            ->namespace($this->namespace.'\\Teacher')
            ->group(base_path('routes/teacher.php'));

        // Agencies Routes
        Route::middleware(['web','auth','checkAgency'])
            ->prefix('agency')
            ->name('agency.')
            ->namespace($this->namespace.'\\Agency')
            ->group(base_path('routes/agency.php'));

        // Offices Routes
        Route::middleware(['web','auth','checkOffice'])
            ->prefix('office')
            ->name('office.')
            ->namespace($this->namespace.'\\Office')
            ->group(base_path('routes/office.php'));

        // students Routes
        Route::middleware(['web','auth','checkStudent'])
            ->prefix('student')
            ->name('student.')
            ->namespace($this->namespace.'\\Student')
            ->group(base_path('routes/student.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
