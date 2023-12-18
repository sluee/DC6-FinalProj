<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::orderBy('id' ,'desc')
        ->when(HttpRequest::input('search'), function ($query, $search) {
            $query->where('position', 'like', '%' . $search . '%');
        })
        ->paginate(8)
        ->withQueryString();


        return inertia('Position/index',[
            'positions' => $positions,
            'filters' => HttpRequest::only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('positions'),
            ],
            'rate' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/positions')  // Replace with the actual route of your form
                ->with('error', 'Position already exists.');
        }
    
        // If validation passes, create the position
        $position = Position::create([
            'name' => $request->input('name'),
            'rate' => $request->input('rate'),
        ]);
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created a position  with the id# " . $position->id;
        event(new UserLog($log_entry));
    
        return redirect('/positions')->with('success', 'Position Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $fields=$request->validate([
            'position' => 'required',
            'rate' => 'required',

        ]);

       $position->update($fields);
       $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a position  with the id# " . $position->id;
       event(new UserLog($log_entry));

        return redirect('/positions')->with('success','Position Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
    }
}
