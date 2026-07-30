<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function indexSettings(){
        return inertia('Backend/Admin/Settings', [
            'settings'=>Setting::first(),
        ]);
    }

    public function settingsUpdate(Request $request){

        $settings = Setting::count();

        if(empty($settings)){
            $valid = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'photo' => 'required',
                'map_url' => 'required',
            ]);

            if($valid->fails()){
                return redirect()->route('admin.settings')->with(
                    'error', 'Error Try Again!',
                );
            }
            $path = null;
            if($request->hasFile('photo')){
                $file = $request->file('photo');
                $filename = time().'_'.$file->getClientOriginalExtension();
                $file->move(public_path('/img/settings'), $filename);
                $path = '/img/settings/'.$filename;
            }
                

            Setting::create([
                'name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact,
                'email' => $request->email,
                'photo' => $path,
                'map_url' => $request->map_url,
            ]);

            return redirect()->route('admin.settings')->with(
                'success', 'Settings Save Successfully!',
            );
        }else {
            $valid = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'photo' => 'required',
                'map_url' => 'required',
            ]);

            if($valid->fails()){
                return redirect()->route('admin.settings')->with(
                    'error', 'Error Try Again!',
                );
            }
            $path = null;
            if($request->hasFile('photo')){
                $file = $request->file('photo');
                $filename = time().'_'.$file->getClientOriginalExtension();
                $file->move(public_path('/img/settings'), $filename);
                $path = '/img/settings/'.$filename;
            }
                

            Setting::findorfail($request->id)->update([
                'name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact,
                'email' => $request->email,
                'photo' => $path,
                'map_url' => $request->map_url,
            ]);

            return redirect()->route('admin.settings')->with(
                'success', 'Settings Save Successfully!',
            );
        }
        
    }
}
