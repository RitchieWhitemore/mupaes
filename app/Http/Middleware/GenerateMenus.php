<?php

namespace App\Http\Middleware;

use Closure;
use Lavary\Menu\Builder;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('mainMenu', function ($menu) {
            /**
             * @var $menu Builder
             */
            $menu->add('Главная');
            $menu->add('Информация', ['href' => '#', 'nickname' => 'info']);
            $menu->info->add('Информация о закупочной деятельности', '#');
            $menu->info->add('Отчеты о закупках', '#');
            $menu->info->add('Информация о закупках', '#');

            $menu->add('Потребителям', '#');
            $menu->add('Закупки', ['nickname' => 'purchase']);
            $menu->purchase->add('Информация о закупочной деятельности', '#');
            $menu->purchase->add('Отчеты о закупках', '#');
            $menu->purchase->add('Информация о закупках', '#');

            $menu->add('Контакты', 'contacts');
        });

        return $next($request);
    }
}
