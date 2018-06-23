<?php

namespace Solunes\Staff;

use Illuminate\Support\ServiceProvider;

class StaffServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot() {
        /* Publicar Elementos */
        $this->publishes([
            __DIR__ . '/config' => config_path()
        ], 'config');
        $this->publishes([
            __DIR__.'/assets' => public_path('assets/staff'),
        ], 'assets');

        /* Cargar Traducciones */
        $this->loadTranslationsFrom(__DIR__.'/lang', 'staff');

        /* Cargar Vistas */
        $this->loadViewsFrom(__DIR__ . '/views', 'staff');
    }


    public function register() {
        /* Registrar ServiceProvider Internos */

        /* Registrar Alias */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        $loader->alias('Staff', '\Solunes\Staff\App\Helpers\Staff');
        $loader->alias('CustomStaff', '\Solunes\Staff\App\Helpers\CustomStaff');

        /* Comandos de Consola */
        $this->commands([
            //\Solunes\Staff\App\Console\AccountCheck::class,
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/config/staff.php', 'staff'
        );
    }
    
}
