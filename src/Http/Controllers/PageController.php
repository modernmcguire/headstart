<?php

namespace ModernMcGuire\Headstart\Http\Controllers;

use ModernMcGuire\Headstart\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        if ( ! auth()->check() && ! $page->isPublished() ) {
            abort(404);
        }

        return view('page.show', [
            'page' => $page,
        ]);
    }
}
