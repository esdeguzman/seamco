<?php

namespace App\Providers;

use App\Comaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       View::composer(
           [
               'member.layout.main',
               'member.show',
               'member.loans.index',
               'member.loans.show',
               'member.loans.create',
           ], function($view) {
           $view->with('comakerRequests', Comaker::where('member_id', Auth::guard('member')->user()->id));
       });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
