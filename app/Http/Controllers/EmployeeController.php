<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Employee/index', [
            'employees' => Employee::query()
                ->with('user', 'position')
                ->when(request()->input('search'), function ($query, $search) {
                    $query->where(function ($subquery) use ($search) {
                        $subquery->whereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('firstName', 'like', '%' . $search . '%')
                                       ->orWhere('lastName', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('position', function ($positionQuery) use ($search) {
                            $positionQuery->where('name', 'like', '%' . $search . '%');
                        });
                    });
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
        return Inertia('employees/create', [
            'position'  => $position
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
            'password'   =>'required|confirmed|string|min:6',

        ]);

        $user = User::create($data);
        $employee = new Employee([
            'pos_id' => $request->input('pos_id'),
        ]);

        $user->employee()->save($employee);
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created an employee with the id# " . $employee->id;
        event(new UserLog($log_entry));
        return redirect('/employees')->with('message', 'Employee successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
