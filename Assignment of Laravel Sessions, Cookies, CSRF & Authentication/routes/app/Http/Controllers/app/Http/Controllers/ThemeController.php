<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function toggle(Request $request)
    {
        $current = $request->cookie('theme', 'light');
        $newTheme = $current === 'light' ? 'dark' : 'light';

        return redirect()->back()->cookie('theme', $newTheme, 60*24*30);
    }
}
