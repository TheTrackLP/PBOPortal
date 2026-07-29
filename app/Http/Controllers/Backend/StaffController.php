<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function BackStaffIndex(){
        $staffs = Staff::select(
            'staff.*',
            'divisions.name as divname'
        )
        ->join('divisions', 'divisions.id', '=', 'staff.divisionid')
        ->get();
        return inertia('Backend/Admin/Staffs', [
            'staffs'=>$staffs,
            'divisions'=>Division::all(),
        ]);
    }

    public function AddStaff(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'designation' => 'required',
            'divisionid' => 'required',
        ]);

        if($valid->fails()){
            return redirect()->route('admin.staff')->with(
                'error', 'Error Try Again!',
            );
        }

        $path = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('img/staffs'), $filename);
            $path = 'img/staffs/'.$filename;
        }
        
        Staff::create([
            'name' => strtoupper($request->name),
            'position' => strtoupper($request->position),
            'designation' => strtoupper($request->designation),
            'photo' => $path,
            'divisionid' => $request->divisionid,
        ]);
        return redirect()->route('admin.staff')->with(
            'success', 'Added Staff Success!',
        );
    }
}
