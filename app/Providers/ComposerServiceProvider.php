<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
//        all view "*"
        View::composer('components.answer', function ($view) {
           $view->with(['answers' => Answer::get()]);
        });

        View::composer('components.question', function ($view) {
            $view->with(['questions' => Question::get()]);
        });

    }
}
