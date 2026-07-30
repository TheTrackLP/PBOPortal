<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function BackStaffIndex(){
        $staffs = Staff::select(
            'staff.*',
            'divisions.name as divname'
        )
        ->leftJoin('divisions', 'divisions.id', '=', 'staff.divisionid')
        ->orderBy('staff.order', 'asc')
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
            $file->move(public_path('/img/staffs'), $filename);
            $path = '/img/staffs/'.$filename;
        }

        $lastOrder = Staff::whereNotNull('order')
            ->orderBy('order', 'desc')
            ->first();

        $nextOrder = $lastOrder ? $lastOrder->order + 1 : 1;
        
        Staff::create([
            'name' => strtoupper($request->name),
            'position' => strtoupper($request->position),
            'designation' => strtoupper($request->designation),
            'photo' => $path,
            'divisionid' => $request->divisionid,
            'order' => $nextOrder,
        ]);

      
        return redirect()->route('admin.staff')->with(
            'success', 'Added Staff Success!',
        );
    }

    public function UpdateStaff(Request $request){
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

        $staff = Staff::find($request->id);
        if (!$staff) {
            return redirect()->route('admin.staff')->with(
                'error', 'Staff not found!',
            );
        }

        $path = $staff->photo;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('/img/staffs'), $filename);
            $path = '/img/staffs/'.$filename;
        }

        $staff->update([
            'name' => strtoupper($request->name),
            'position' => strtoupper($request->position),
            'designation' => strtoupper($request->designation),
            'photo' => $path,
            'divisionid' => $request->divisionid,
        ]);
        return redirect()->route('admin.staff')->with(
            'success', 'Updated Staff Success!',
        );
    }

    public function changeStaffStatus($id){
        $staff_id = Staff::findorfail($id);

        if($staff_id->isActive == 1){
            $staff_id->update([
                'isActive' => 0
            ]);
        } elseif ($staff_id->isActive == 0){
            $staff_id->update([
                'isActive' => 1
            ]);
        }

        return redirect()->route('admin.staff')->with(
            'success', 'Status Change',
        );
    }

    public function staffOrder(Request $request){
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:staff,id',
        ]);
        
        foreach ($request->order as $index => $staffId) {
            Staff::where('id', $staffId)->update(['order' => $index + 1]);
        }

        return redirect()->route('admin.staff')->with(
            'success', 'Order!',
        );
    }
}
