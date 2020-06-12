<?php


namespace App\Http\Controllers;


use App\Models\Page;

class ArticleController extends Controller
{
    public function information()
    {
        $information = Page::isPromotions()->orderByDesc('created_at')->notHidden()->paginate(15);
        return view('public.promotion', compact('promotions'));
    }
}
