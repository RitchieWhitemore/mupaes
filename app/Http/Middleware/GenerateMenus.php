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
            $menu->info->add('Раскрытие информации', 'information-disclosure');
            $menu->info->add('Новости и События', 'news');
            $menu->info->add('Продажа имущества', '#');

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
