<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        \App\Models\AiFeature::class      => \App\Policies\AiFeaturePolicy::class,
        \App\Models\Banner::class         => \App\Policies\BannerPolicy::class,
        \App\Models\Cancer::class         => \App\Policies\CancerPolicy::class,
        \App\Models\Dashboard::class      => \App\Policies\DashboardPolicy::class,
        \App\Models\FeatureOption::class  => \App\Policies\FeatureOptionPolicy::class,
        \App\Models\History::class        => \App\Policies\HistoryPolicy::class,
        \App\Models\News::class           => \App\Policies\NewsPolicy::class,
        \App\Models\Organization::class   => \App\Policies\OrganizationPolicy::class,
        \App\Models\User::class           => \App\Policies\UserPolicy::class,
    ];


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
