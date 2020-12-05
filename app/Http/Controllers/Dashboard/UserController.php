<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use UxWeb\SweetAlert\SweetAlert;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where( function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);

        return view('dashboard.users.index', compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'image' => 'required|image',
            'permissions' => 'required|min:1'
        ]);

        $data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $data['password'] = bcrypt($request->password);

        if ($request->image) {
            $poster = Image::make($request->image)->encode('jpg');
            Storage::disk('local')->put('public/images/Users/' . $request->image->hashName(), (string)$poster, 'public');
            $data['image'] = request()->image->hashName();
        }

        $user = User::create($data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        SweetAlert::message('The User Added Successfully!');

        return redirect()->route('users.index');
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        // return $user;
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'email' => ['required', Rule::unique('user')->ignore($user->id)],
            'email' => ['required'],
            'image' => 'image',
            'permissions' => 'required|min:1'


        ]);

        $user_data = $request->except(['permissions', 'image']);

        if ($request->image) {
            if ($user->image != 'avatar.png') {
                Storage::disk('public')->delete($user->image);
            }

            $poster = Image::make($request->image)->encode('jpg');
            Storage::disk('local')->put('public/images/Users/' . $request->image->hashName(), (string)$poster, 'public');
            $user_data['image'] = request()->image->hashName();
        }

        $user->update($user_data);
        $user->syncPermissions($request->permissions);
        return redirect()->route('users.index')->with(['success' => 'The User Updated Successfully']);
    }


    public function destroy(User $user)
    {
        if ($user->image != 'avatar.png') {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return redirect()->route('users.index')->with(['success' => 'The User Deleted Successfully']);
    }
}
