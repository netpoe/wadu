<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Model\{
    User\UserAdapter as User,
    User\UserRoleAdapter as UserRole,
    User\UserInfoAdapter as UserInfo
};

class BusinessController extends Controller
{
    public function users()
    {
        $business = Auth::user()->business;

        return view('admin.business.users', [
            'business' => $business,
        ]);
    }

    public function createUser(Request $request)
    {
        // TODO validate input
        // TODO let user choose a password on first login

        $user = User::create([
            'email' => $request->input('email'),
            'role_id' => UserRole::EMPLOYEE,
            'business_id' => Auth::user()->business->id,
            'password' => Hash::make('password')
        ]);

        $info = UserInfo::create([
            'user_id' => $user->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        return redirect()->route('admin.business.users');
    }

    public function updateUser(User $user, Request $request)
    {
        // TODO validate input

        $user->where('id', $user->id)->update([
            'email' => $request->input('email')
        ]);

        return redirect()->route('admin.business.users');
    }
}
