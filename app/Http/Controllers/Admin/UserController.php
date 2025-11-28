<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::OrderBy('id','DESC')->paginate(15);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'      => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'role'      => 'required|in:admin,super admin',
            'profile'   => 'nullable|image|max:2048'
        ]);

        // Process image upload
        $profile_path = null;
        if ($request->hasFile('profile')) {
            $fileName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images/users'), $fileName);
            $profile_path = 'images/users/' . $fileName;
        }
       
        // Create user
        User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'profile'  => $profile_path,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('backend.users.index')
                         ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validation
        $request->validate([
            'name'      => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'email'     => 'required|email|unique:users,email,'.$id,
            'role'      => 'required|in:admin,super admin',
            'profile'   => 'nullable|image|max:2048',
        ]);

        // Update image if new one uploaded
        if ($request->hasFile('profile')) {
            // delete old image
            if ($user->profile && file_exists(public_path($user->profile))) {
                unlink(public_path($user->profile));
            }
            $fileName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images/users'), $fileName);
            $user->profile = 'images/users/' . $fileName;
        }

        // Update data
        $user->update([
            'name'  => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('backend.users.index')
                         ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users=User::find($id);
       $users->delete();
       return redirect()->route('backend.users.index');
    }
}