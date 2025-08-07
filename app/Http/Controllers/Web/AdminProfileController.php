<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ImageManger;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class AdminProfileController extends Controller
{
    public function profile()
    {
        $user = Admin::where('id', auth()->user()->id)->first();
        return view('Admin.pages.profile.updateProfile', compact('user'));
    }

    public function updateProfile(AdminProfileRequest $profileRequest)
    {
        $user = auth()->user();
        $data = $profileRequest->validated();
        if (isset($data['image'])) {
            if ($user->image) {
                (new ImageManger())->deleteImage($user->image);
            }
            $imagePath = (new ImageManger())->uploadImage('uploads/users', $data['image']);
            $data['image'] = $imagePath;
        }
        $user->update($data);
        Session::flash('message', ['type' => 'success', 'text' => __('User updated successfully')]);
        return redirect()->back();
    }
}
