<?php

namespace App\Http\Middleware;

use Closure;
use Lavary\Menu\Builder;
use Whitemore\Menu\Models\Menu;

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

            /**
             * @var $itemsMenu Menu
             */
            $itemsMenu = Menu::defaultOrder()->withDepth()->having('depth', '>=', 1)->get()->toFlatTree();

            foreach ($itemsMenu as $item) {


                $menu->add($item->title, [
                    'url' => $item->getUrl(),
                    'parent' => $item->parent->id == 1 ? null : $item->parent->id,
                    'empty' => $item->isEmpty(),
                    'depth' => $item->depth,
                ])->id($item->id);
            }
        });

        return $next($request);
    }

    protected function buildSubMenu($item)
    {

    }
}
