<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalSettingsController extends Controller
{
    public function globalSettings(){
        return inertia('Frontend/Navbar');
    }
}
