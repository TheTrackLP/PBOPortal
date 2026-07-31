<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\mandateItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function aboutIndex(){
        return inertia('Backend/Admin/About',[
            'about'=>About::first(),
            'mandate'=>mandateItems::all(),
        ]);
    }

    public function AddUpdateAboutPage(Request $request){

        $check = About::count();

        if(empty($check)){
            $valid = Validator::make($request->all(), [
                'mission_title' => "required",
                'mission_content' => "required",
                'vision_title' => "required",
                'vision_content' => "required",
                'org_outcome_title' => "required",
                'org_outcome_content' => "required",
            ]);
    
            if($valid->fails()){
                return redirect()->route('admin.about')->with(
                    'error', 'Error, Try Again!',
                );
            }
                
            About::create([
                'mission_title' => $request->mission_title,
                'mission_content' => $request->mission_content,
                'vision_title' => $request->vision_title,
                'vision_content' => $request->visiosn_content,
                'org_outcome_title' => $request->org_outcome_title,
                'org_outcome_content' => $request->org_outcome_content,
            ]);
                
            return redirect()->route('admin.about')->with(
                'success', 'Success!',
            );
            
            } else {         

                $valid = Validator::make($request->all(), [
                    'mission_title' => "required",
                    'mission_content' => "required",
                    'vision_title' => "required",
                    'vision_content' => "required",
                    'org_outcome_title' => "required",
                    'org_outcome_content' => "required",
                ]);
        
                if($valid->fails()){
                    return redirect()->route('admin.about')->with(
                        'error', 'Error, Try Again!',
                    );
                }
                    
                About::findorfail($request->id)->update($request->all());
                    
                return redirect()->route('admin.about')->with(
                    'success', 'Success!',
                );
        }
    }

    public function AddUpdateMandate(Request $request){
        $request->validate([
            'mandateArray'=>'required|array',
            'mandateArray.*.content'=> 'required|string'
        ]);

        foreach ($request->mandateArray as $index => $value) {
            mandateItems::create([
                'content' => $value['content'],
            ]);
        }

        return redirect()->route('admin.about')->with(
            'success', 'Success!',
        );        
    }
}
