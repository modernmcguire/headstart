<?php

namespace ModernMcGuire\Headstart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ModernMcGuire\Headstart\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;


class DashboardController extends BaseController
{
    public function show()
    {
    	return view('admin.dashboard.show');
    }
}
