<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        $category->uploadImage('image', $request, 'images');

        return redirect()->route('admin.categories.show', $category);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $parents = Category::defaultOrder()->withDepth()->get();

        return view('admin.category.edit', compact('category', 'parents'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        $category->uploadImage('image', $request, 'images');

        return redirect()->route('admin.categories.show', $category);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if ($category->children()->count() > 0 || $category->pages()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'У этой категории есть подчиненные');
        }
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

    public function items()
    {
        $categories = Category::treeList()->select(['id', 'name as text'])->get()->prepend([
            'id' => 0,
            'text' => 'Выберите элемент...'
        ]);

        return response()->json([
            'items' => $categories,
        ], 200);
    }
}
