<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employers = Employer::all();
        return view('pages.employers.employers', compact('employers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.employers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email',
            'company_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        Employer::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('employers')->with('success', 'Employer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employer = Employer::find($id);
        return view('pages.employers.edit',compact('employer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $employer = Employer::find($id);

        $employer->update([
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('employers')->with('success', 'Employer update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employer = Employer::find($id);

        if (!$employer) {
            return redirect()->route('employers')->with('error', 'Employer not found.');
        }

        $employer->delete();

        return redirect()->route('employers')->with('success', 'Employer removed successfully.');
    }
    
}
