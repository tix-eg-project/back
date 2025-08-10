<?php

namespace App\Http\Controllers\Web\Admin\User;

use Illuminate\Http\Request;
use App\Models\{User, ModelHasRole};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Hash, Session};
use App\Http\Requests\User\{StoreUserRequest, UpdateUserRequest, ProfileRequest};


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('id', '!=', auth()->id())
            ->latest();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $users = $query->paginate(10);
        return view('Admin.pages.users.index', compact('users'));
    }


    // public function create()
    // {

    //     // $roles = Role::select(['id', 'name'])->get();
    //     $countries = Country::all();
    //     $cities = City::all();
    //     return view('Admin.pages.users.create', compact('roles', 'countries', 'cities'));
    // }

    // public function store(StoreUserRequest $storeUserRequest)
    // {
    //     $data = $storeUserRequest->validated();
    //     $data['password'] = Hash::make($storeUserRequest->password);
    //     $user = User::create(collect($data)->except('image')->toArray());
    //     if ($storeUserRequest->hasFile('image')) {
    //         MediaHelper::uploadMedia($user, $storeUserRequest->file('image'), AuthEnum::AVATAR_COLLECTION_NAME);
    //     }
    //     if (isset($data['role_id'])) {
    //         DB::table('model_has_roles')->insert([
    //             'model_type' => User::class,
    //             'model_id' => $user->id,
    //             'role_id' => $data['role_id'],
    //         ]);
    //     }
    //     Session::flash('message', ['type' => 'success', 'text' => __('User created successfully')]);
    //     return redirect()->route('admin.pages.users.index');
    // }

    // public function edit(User $user)
    // {
    //     $roles = Role::select(['id', 'name'])->get();
    //     $countries = Country::all();
    //     $cities = City::all();
    //     return view('Admin.pages.users.edit', compact('user', 'roles', 'countries', 'countries', 'cities'));
    // }

    // public function update(UpdateUserRequest $updateUserRequest, User $user)
    // {

    //     $data = $updateUserRequest->validated();
    //     $data['password'] = $updateUserRequest->password ? Hash::make($updateUserRequest->password) : $user->password;
    //     if ($updateUserRequest->hasFile('image')) {
    //         MediaHelper::uploadMedia($user, $updateUserRequest->file('image'), AuthEnum::AVATAR_COLLECTION_NAME);
    //     }
    //     $user->update($data);
    //     if (isset($data['role_id']) && !empty($data['role_id'])) {
    //         $criteria = ['model_id' => $user->id];
    //         $attributes = [
    //             'model_type' => 'App\\Models\\User',
    //             'model_id' => $user->id,
    //             'role_id' => $updateUserRequest->role_id
    //         ];
    //         DB::table('model_has_roles')->updateOrInsert($criteria, $attributes);
    //     } else {
    //         DB::table('model_has_roles')->where('model_id', $user->id)->delete();
    //     }
    //     Session::flash('message', ['type' => 'success', 'text' => __('User updated successfully')]);
    //     return redirect()->route('admin.pages.users.index');
    // }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('admin')) {
            return redirect()->back()->with('Error', 'لا يمكن حذف مستخدم Admin.');
        }
        $user->delete();
        return redirect()->back()->with('delete', 'تم حذف المستخدم بنجاح.');
    }
}
