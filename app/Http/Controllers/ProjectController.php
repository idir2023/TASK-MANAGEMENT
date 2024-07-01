<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('pages.projects.projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employers = Employer::all();
        return view('pages.projects.create', compact('employers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'employer_id' => 'required|exists:employers,id',
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'employer_id' => $request->employer_id,
        ]);

        return redirect()->route('projects')->with('success', 'Project created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employers = Employer::all();
        $projects = Project::find($id);

        return view('pages.projects.edit', compact('employers', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'employer_id' => 'required|exists:employers,id',
        ]);

        $project = Project::find($id);

        if (!$project) {
            return redirect()->route('projects')->with('error', 'Project not found.');
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'employer_id' => $request->employer_id,
        ]);

        return redirect()->route('projects')->with('success', 'Project updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if ($project) {
            $project->delete();
            return redirect()->route('projects')->with('success', 'Projet supprimée avec succès.');
        } else {
            return redirect()->route('projects')->with('error', 'Projet non trouvée.');
        }
    }
}
