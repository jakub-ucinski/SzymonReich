<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show(Page $page)
    {
        // dd($page);
        return view('pages.show', compact('page'));
    }
}
