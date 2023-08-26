<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register():void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot():void
    {
        Blade::directive('flash', function ($type) {
            $class = '';
            $icon = '';
            switch ($type) {
                case 'success':
                    $class = 'success';
                    $icon = 'fa-check';
                    break;
                case 'failed':
                    $class = 'failed';
                    $icon = 'fa-xmark';
                    break;
                case 'question':
                    $class = 'question';
                    $icon = 'fa-question';
                    break;
            }
            return "<?php if (session()->has('$type')): ?>
                        <div class='flash-message $class'>
                            <i class='fa-solid $icon'></i>
                            <p>{{ session('$type') }}</p>
                        </div>
                    <?php endif; ?>";
        });
    }    
}
