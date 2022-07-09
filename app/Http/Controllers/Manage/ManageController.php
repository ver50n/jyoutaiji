<?php
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageController extends Controller
{
    public function dashboard()
    {
        return view('manage.dashboard', [
        ]);
    }

    public function setting()
    {
        return view('manage.setting', []);
    }
  
    public function changePasswordPost(Request $request)
    {
        $id = \Auth::guard('admin')->id();
        $data = $request->all();
        $obj = \App\Models\Admin::findOrFail($id);
        $res = $obj->changePassword($data);
  
        if($res != true) {
            return redirect()->back()
                ->with('error', \Lang::get('common.change-password-error'));
        }
        return redirect()->back()
          ->with('success', \Lang::get('common.change-password-succed'));
    }
}