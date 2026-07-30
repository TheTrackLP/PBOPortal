<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Staff;
use App\Models\Division;

class StaffController extends Controller
{
    public function StaffIndex(){
        $leadership = Staff::whereIn('category', ['head', 'acting_head'])
        ->where('isActive', 1)
        ->orderBy('order')
        ->get();

        $staffs = Staff::select(
            'staff.*',
            'divisions.name as divname'
        )
        ->leftJoin('divisions', 'divisions.id', '=', 'staff.divisionid')
        ->where([
            ['staff.category', 'staff'],
            ['staff.isActive', 1]
        ])
        ->orderBy('staff.order', 'asc')
        ->get();
        return inertia('Frontend/Staff', [
            'staffs'=>$staffs,
            'leadership'=>$leadership,
            'divisions'=>Division::all(),
        ]);
    }
}
