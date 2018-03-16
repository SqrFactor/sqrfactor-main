<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,


        ],


        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'social' => \App\Http\Middleware\Social::class,
        'work_status_design_article' => \App\Http\Middleware\WorkStatusDesignArticle::class,
        'status_design_article_compition_announcment' => \App\Http\Middleware\StatusDesignArticleCompitionAnnouncment::class,
        'profile_flag' => \App\Http\Middleware\ProfileFlag::class,
        'work' => \App\Http\Middleware\Work::class,
        'work2' => \App\Http\Middleware\Work2::class,
        'hire' => \App\Http\Middleware\Hire::class,
        'hire2' => \App\Http\Middleware\Hire2::class,
        'workEducationDetails' =>  \App\Http\Middleware\WorkEducationDetails::class,
        'workProfessionalDetails' => \App\Http\Middleware\WorkProfessionalDetails::class,
        'workCompanyFirmDetails' => \App\Http\Middleware\WorkCompanyFirmDetails::class,
        'hireEmployeeDetails' => \App\Http\Middleware\HireEmployeeDetails::class,
        'competitionMiddleware' => \App\Http\Middleware\CompetitionMiddleware::class,
        'if_user_individual' => \App\Http\Middleware\Individual::class,


    ];

}
