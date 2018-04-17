<?php

namespace App\Providers;

use App\Comaker;
use App\Loan;
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
           $view->with([
               'comakerRequests' => Comaker::where('member_id', Auth::guard('member')->user()->id),
               'approvedLoans' => Loan::doesntHave('promissoryNote')->where('member_id', Auth::guard('member')->user()->id)->where('remarks', null)->get(),
           ]);
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
