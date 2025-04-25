<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class PagesController extends Controller
{
    public function index() 
    {
        $settings = Settings::where('id', 1)->first();
        return view('welcome', [
            'settings' => $settings,
        ]);
    }
}
