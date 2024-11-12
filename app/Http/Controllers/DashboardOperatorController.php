<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function index()
    {
        $users = User::where('role', 'operator')->latest()->get();
        return view('dashboard.operator.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.operator.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);
        
        // dd($validateData);
        
        User::create($validateData);

        return redirect()->route('operator.index');
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
        return view('dashboard.operator.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        
        // dd($validateData);
        
        User::whereId($id)->update($validateData);

        return redirect()->route('operator.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (auth()->user()->role == 'operator') {
            return redirect()->route('operator.index')->with('error', 'Operator tidak memiliki izin untuk menghapus data.');
        }

        User::destroy($id);
        return redirect()->route('operator.index')->with('success', 'Data berhasil dihapus.');
    }

}