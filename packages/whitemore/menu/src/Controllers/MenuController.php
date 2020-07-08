<?php

namespace Whitemore\Menu\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;
use Whitemore\Menu\Models\Menu;
use Whitemore\Menu\Requests\MenuRequest;
use Whitemore\Menu\src\Models\MenuBuilder;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::defaultOrder()->withDepth()->having('depth', '>=', 1)->get()->toTree();

        $menuBuilder = new MenuBuilder();
        $menuTreeHtml = $menuBuilder->getTree($menu);
        return view('menu::admin.index', compact('menu', 'menuTreeHtml'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parentId = 0)
    {
        return view('menu::admin.create', compact('parentId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu = Menu::create($request->all());

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menu::admin.show', ['model' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu::admin.edit', ['model' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($request->all());

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->children()->count() > 0) {
            return redirect()->route('menu.index')->with('error', 'У этого элемента есть подчиненные');
        }
        $menu->delete();
        return redirect()->route('menu.index');
    }

    public function updateOrder(Request $request)
    {
        $menu = Menu::find($request->id);

        if ($request->position > $request->oldPosition) {
            $menu->down($request->position - $request->oldPosition);
        } else {
            $menu->up($request->oldPosition - $request->position);
        }

        $menu->save();

        return response()->json(['status' => 'success', 'id' => $menu->id, 'newPosition' => $request->position]);
    }

    public function item(Menu $menu)
    {
        switch ($menu->item_type) {
            case Page::class:
                $page = $menu->item()->firstOrFail();
                return view('public.article.page', compact('page', 'menu'));
            case Category::class:
                $category = $menu->item()->firstOrFail();
                $pages = $category->pages()->notHidden()->paginate(15);
                return view('public.article.category', compact('category', 'menu', 'pages'));
        }

        return null;
    }

    public function page(Page $page, Menu $menu)
    {
        return view('public.article.page', compact('page', 'menu'));
    }

}
