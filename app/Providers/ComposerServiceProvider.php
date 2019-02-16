<?php

namespace App\Providers;

use App\Comaker;
use App\Loan;
use Carbon\Carbon;
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
               'comakerRequests' => Comaker::has('loan')->where('member_id', Auth::guard('member')->user()->id)->orderBy('created_at', 'desc'),
               'approvedLoans' => Loan::doesntHave('promissoryNote')
                                    ->where('member_id', Auth::guard('member')
                                    ->user()->id)->where('remarks', null)
                                    ->where('status', '!=', null)
                                    ->whereDate('updated_at', '>=', Carbon::now()->subDays(5)->toDateTimeString())
                                    ->get(),
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
