<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactIndex(){
        return inertia('Frontend/ContactUs', [
            'settings'=>Setting::first(),
        ]);
    }
}
