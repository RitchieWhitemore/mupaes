<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Page;

class ArticleController extends Controller
{
    public function information()
    {
        $information = Page::isCategorySlug('info')->orderByDesc('created_at')->notHidden()->paginate(15);
        return view('public.information', compact('information'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', '=', $slug)->firstOrFail();
        $pages = Page::isCategorySlug($slug)->orderByDesc('created_at')->notHidden()->paginate(15);
        return view('public.article.category', compact('pages', 'category'));
    }

    public function page($path, $page)
    {
        //$page = Page::isCategorySlug($categorySlug)->where('slug', '=', $slug)->notHidden()->firstOrFail();
        return view('public.article.page', compact('page'));
    }
}
