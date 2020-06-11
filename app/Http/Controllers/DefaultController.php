<?php


namespace App\Http\Controllers;


class DefaultController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function contacts()
    {
        return view('public.contacts');
    }
}
