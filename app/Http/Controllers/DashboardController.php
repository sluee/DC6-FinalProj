<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $auth = User::where('status', 1)->count();
        $payroll = Payroll::count();

        $user = auth()->user(); // Get the authenticated user

        $query = CashAdvance::with('employee.user')
            ->orderBy('id', 'desc');
        
        if ($user->type === 'employee') {
            // If the user is an employee, filter the cash advances for that specific employee
            $query->whereHas('employee.user', function ($q) use ($user) {
                $q->where('id', $user->id);
            });
        }
        
        $cashAdvance = $query->paginate(6);
        // $userCount = User::count();
        return inertia('Dashboard',[
            'user' => $auth,
            'payroll' => $payroll,
            'cashAdvance' => $cashAdvance
        ]);
    }
}
