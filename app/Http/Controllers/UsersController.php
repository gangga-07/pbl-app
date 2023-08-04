<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function allUser()
    {
        $data = [
            'title' => 'Users | PBL-APP',
            // 'users' => User::where('level', 'user')->latest()->filter(request(['search']))->paginate(10),
        ];
        $user = User::all();
        return view('dashboard.admin.users.user-all', $data, compact('user'));
    }

    public function detailProfile(User $user)
    {
        $data = [
            'title' => 'Update Profile | PBL-APP',
            'user' => $user->where('id', auth()->user()->id)->first()
        ];
        return view('dashboard.profile-detail', $data);
    }

    public function my_account(User $user)
    {
        $data = [
            'title' => 'Detail My Account | PBL-APP',
            'user' => $user->where('id', auth()->user()->id)->first(),
        ];
        return view('frontpage.my-account.my-account', $data);
    }

    public function updateProfile(User $user)
    {
        $data = [
            'title' => 'Update Profile | PBL-APP',
            'user' => $user->where('id', auth()->user()->id)->first()
        ];
        return view('frontpage.my-account.my-account-update', $data);
    }

    public function patchProfile(Request $request, User $user)
    {
        if ($request->email != $user->email) {
            if (User::where('email', $user->email)->whereNot('id', $user->id)->count()) {
                return redirect()->back()->withInput()->with('error', 'This Email Has Been Used, Please Input Another Email');
            } else {
                $email_validator = Validator::make($request->all(), [
                    'email' => 'required|unique:users,email|email:dns',
                ]);

                if ($email_validator->fails()) {
                    return redirect()->back()->withErrors($email_validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
                }

                $validated_email = $email_validator->validate();
                $user->update(['email' => $validated_email['email']]);
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:8|max:50',
            'email' => 'required|email:dns',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            // 'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
        }
        $validated = $validator->validate();
        $user_is_updated = $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            // 'password' => Hash::make($validated['password']),
        ]);
        if ($user_is_updated) {
            return redirect()->route('my-account', ['user' => auth()->user()])->with('success', 'Your Account Successfully Updated');
        }
        redirect()->route('login')->with('error', 'Update Proccess Failed! <br> Please Try Again Later!');
    }

    public function deleteUser(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('manage_user.all')->with('success', 'User @' . $user->name . ' Successfully Deleted');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }

    public function showPassword()
    {
        return view('frontpage.my-account.change-password');
    }

    public function updatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        // Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        // Logout the user after updating the password
        Auth::logout();

        return redirect()->route('login')->with('success', 'Password updated successfully! You have been logged out for security purposes. Please log in with your new password.');
    }
}
