<?php

namespace ModernMcGuire\Headstart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ModernMcGuire\Headstart\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function show()
    {
    	return view('admin.media.show');
    }
}
