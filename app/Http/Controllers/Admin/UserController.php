<?php

// app/Http/Controllers/Admin/UserController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
 use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;




class UserController extends Controller
{
   

public function export() 
{
   return Excel::download(new UsersExport, 'users.xlsx');

}
   public function index(Request $request)
{
    $query = User::query();
    
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
    }
    
    $users = $query->latest()->paginate(10);
    
    return view('admin.users.index', compact('users'));
}
public function impersonate(User $user)
{
    if (auth()->id() === $user->id) {
        return back()->with('error', "You can't impersonate yourself.");
    }

    auth()->user()->impersonate($user);
    return redirect('/')->with('success', "You're now impersonating {$user->name}");
}


public function leaveImpersonate()
{
    if (auth()->user()->isImpersonated()) {
        auth()->user()->leaveImpersonation();
        return redirect()->route('admin.users.index')->with('success', 'Back to admin account');
    }

    return redirect()->back()->with('error', 'Not impersonating any user.');
}


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'sometimes|boolean'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'is_admin' => $validated['is_admin'] ?? false
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'sometimes|boolean'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $validated['is_admin'] ?? false
        ]);

        if ($validated['password']) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
    public function bulkActions(Request $request)
{
    $request->validate([
        'selected_ids' => 'required|array',
        'action' => 'required|string|in:delete,activate,deactivate,make_admin,remove_admin',
    ]);

    $users = User::whereIn('id', $request->selected_ids);

    switch ($request->action) {
        case 'delete':
            $users->delete();
            $message = 'Selected users deleted.';
            break;

        case 'activate':
            $users->update(['is_active' => true]);
            $message = 'Selected users activated.';
            break;

        case 'deactivate':
            $users->update(['is_active' => false]);
            $message = 'Selected users deactivated.';
            break;

        case 'make_admin':
            $users->update(['is_admin' => true]);
            $message = 'Selected users are now admins.';
            break;

        case 'remove_admin':
            $users->update(['is_admin' => false]);
            $message = 'Selected users are no longer admins.';
            break;

        default:
            $message = 'No action performed.';
    }

    return redirect()->back()->with('success', $message);
}

}