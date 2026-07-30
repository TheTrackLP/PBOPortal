<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Staff;
use App\Models\Division;

class StaffController extends Controller
{
    public function StaffIndex(){
        return inertia('Frontend/Staff', [
            'staffs'=>Staff::all(),
            'divisions'=>Division::all(),
        ]);
    }
}
