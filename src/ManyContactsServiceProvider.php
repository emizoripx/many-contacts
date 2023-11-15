<?php

namespace EmizorIpx\ManyContacts;

use EmizorIpx\WhatsappCloudapi\Utils\ManyContactsSendHelper;
use Illuminate\Support\ServiceProvider;

class ManyContactsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . "/Database/Migrations");

        // ROUTES
        $this->loadRoutesFrom(__DIR__ . "/Routes/api.php");


        // FACADES
        $app = $this->app;

        /* $app->bind('send_whatsapp_text_message', function() { */

        /*     return new ManyContactsSendHelper(); */
        /* }); */
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // MIGRATIONS

        $this->loadMigrationsFrom(__DIR__ . "/Database/Migrations");

        // ROUTES
        $this->loadRoutesFrom(__DIR__ . "/Routes/api.php");


        # CONFIG FILE
        $this->publishes([
            __DIR__ . "/Config/manycontacts.php" => config_path('manycontacts.php')
        ]);

        $this->mergeConfigFrom(__DIR__ . '/Config/manycontacts.php', 'manycontacts');
    }
}
