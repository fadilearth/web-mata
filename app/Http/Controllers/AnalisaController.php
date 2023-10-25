<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalisaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Analisa Mata',
        ];
        return view('analisa', compact('data'));
    }
}
