<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(['header' => 'My Account']);
            $event->menu->add([
                'text' => auth::user()->name,
                'url' => '/',
                'icon' => 'fa fa-user',
            ]);
            $event->menu->add([
                'text' => 'change_password',
                'url'  => 'pages/change-password',
                'icon' => 'fa fa-lock',
            ]);
        });
    }
}
