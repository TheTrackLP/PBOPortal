<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
    public function divisionIndex(){
        return inertia('Backend/Admin/Division', [
            'divisions'=>Division::all(),
        ]);
    }

    public function divisionAdd(Request $request){
        $valid = Validator::make($request->all(),[
            'name'=>'required',
        ]);

        if($valid->fails()){
            return redirect()->route('admin.div')->with(
                'error', 'Error Try again!',
            );
        }
            
        Division::create([
            'name' => strtoupper($request->name),
        ]); 
            
        return redirect()->route('admin.div')->with(
            'success', 'Success, Added Division!',
        );
    }
}
