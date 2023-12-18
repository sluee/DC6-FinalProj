<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return inertia('User/index', [
            'users' => User::query()
                ->with('roles')
                ->when(request()->input('search'), function ($query, $search) {
                    $query->where('firstName', 'like', '%' . $search . '%')
                        ->orWhere('lastName', 'like', '%' . $search . '%');
                })
                ->paginate(7)
                ->withQueryString(),
            'filters' => request()->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $position = Position::all();

        return inertia('User/create', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'positions' => $position
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'type' => 'required',
            'password' => 'required',
            'role' => 'required', // Include 'role' in validation
        ]);

        $data['password'] = bcrypt($data['password']); // Hash the password

        unset($data['role']);
        $type = $data['type'];
        $role = $request->role;

        $user = User::create($data);

        $user->assignRole($role);

         if ($type === 'employee') {
            // Handle the ",employee" type here.
            $position = $request->input('pos_id');


            // Create a new employee associated with the user
            $employee = new Employee([
                'pos_id' => $position,
            ]);

            // Save the employee first to get an ID.
            $user->employee()->save($employee);

        }

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created a User with the id# " . $user->id;
        event(new UserLog($log_entry));

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('employee.position','roles')->where('user_id', $user->id);
        $position = Position::all();
        $roles = Role::all();

        return inertia('User/edit', [
            'user' => $user,
            'roles' => $roles,
            'positions' => $position,
            'currentRole' => $user->roles->first()->name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'password' => 'nullable|string',
            'role' => 'required',
            'status' => 'required',
        ]);

        if (isset($data['password']) && $data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Remove the "password" field from the data array
        }

        // Use a database transaction for data consistency
        DB::transaction(function () use ($user, $data, $request) {
            $user->update($data);

            // Simplify role syncing
            $user->syncRoles([$data['role'], $data['type']]);

         // ...
        if (in_array($data['type'], [ 'employee', 'admin'])) {
            // If the user type is one of the specified types ('Employee', 'Owner', 'Admin'),
            // update or create the employee record
            $pos_id = $request->input('pos_id');
            $employee = $user->employee;

            if ($employee) {
                // If the employee record already exists, update it
                $employee->pos_id = $pos_id;
                $employee->save();
            } else {
                // If the employee record does not exist, create a new one
                $employee = new Employee(['pos_id' => $pos_id]);
                $user->employee()->save($employee);
            }
        } else {
            // If the user type is not one of the specified types, delete the employee record if it exists
            $user->employee()->delete();
        }


        });

        return redirect()->route('user.index')->with('success', 'User updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
