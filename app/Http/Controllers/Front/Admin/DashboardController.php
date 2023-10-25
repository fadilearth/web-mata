<?php

namespace App\Http\Controllers\Front\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'submenu' => null,
            'title_content' => 'Dashboard',
            'breadcrumb' => [
                [
                    'title' => 'Home',
                    'link' => route('home'),
                ],
                [
                    'title' => 'Dashboard',
                    'link' => null,
                ]
            ]
        ];
        return view('front.admin.dashboard.index', compact('data'));
    }
}
