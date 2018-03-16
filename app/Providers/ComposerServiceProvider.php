<?php

namespace App\Providers;


use App\Country;
use App\User;
use App\UserCompetition;
use App\UserDetail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;


class ComposerServiceProvider extends ServiceProvider
{
    /** 
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    view()->composer('users.partials.user-right-sidebar', function ($view){
          $friend_suggestions = User::whereIn('id',['2','32'])->get();
          
          $competitions =  UserCompetition::select('slug','competition_title','brief')->orderBy('id','desc')->limit(3)->get();
          return $view->with([
            'friend_suggestions'=> $friend_suggestions,
             'featured_compitions' =>  $competitions]);
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
