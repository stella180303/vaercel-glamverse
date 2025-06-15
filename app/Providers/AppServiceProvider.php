<?php
    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Midtrans\Config;
    use Illuminate\Filesystem\Filesystem;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void
        {
            $this->app->singleton('files', function ($app) {
                return new Filesystem;
            });
        }

        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            Config::$serverKey = 'SB-Mid-server-rf0Qaa7RwzntcofhycLlDWQS';
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;
        }
    }
