<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TasksExport;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('pages.tasks.tasks', compact('tasks'));
    }

    public function taskCompleted(){
        // Fetch all tasks where the status is 'completed'
        $tasks = Task::where('status', '=', 'completed')->get();

        // Pass the tasks to the 'taskCompleted' view
        return view('pages.tasks.taskCompleted', compact('tasks'));
    }

    public function taskArchive(){
        $tasks = Task::withTrashed()->whereNotNull('deleted_at')->get();
        return view('pages.tasks.taskArchive', compact('tasks'));
    }


    public function export()
    {
        return Excel::download(new TasksExport, 'tasks.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();

        return view('pages.tasks.create',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|in:normal,low,high',
            'status' => 'required|in:pending,in_progress,completed',
            'project_id' => 'required|exists:projects,id',

        ]

    );

        // Création de la tâche avec les données validées et l'utilisateur actuel
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->project_id = $request->project_id;

        $task->assigned_to = Auth::user()->id;
        $task->save();

        // Redirection avec un message de succès
        return redirect()->route('tasks')->with('success', 'Tâche ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('pages.tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $projects = Project::all();

        return view('pages.tasks.edit', compact('task','projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,normal,high',
            'status' => 'required|in:pending,in_progress,completed',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('tasks')->with('error', 'Tâche non trouvée.');
        }

        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->assigned_to = Auth::user()->id;
        $task->save();

        return redirect()->route('tasks')->with('success', 'Tâche mise à jour avec succès.');
        // return \Jeybin\Toastr\Toastr::success('Tâche mise à jour avec succès.')->redirect('tasks');

    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $status = $request->status;
            $priority = $request->priority;

            $tasks = Task::where(function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->when($status, function($query, $status) {
                    return $query->where('status', $status);
                })
                ->when($priority, function($query, $priority) {
                    return $query->where('priority', $priority);
                })
                ->get();

            if ($tasks->count() > 0) {
                foreach ($tasks as $key => $task) {
                    $output .= '<tr class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <td class="py-2 px-4 text-center">' . ($key + 1) . '</td>
                                    <td class="py-2 px-4 text-center">' . $task->title . '</td>
                                    <td class="py-2 px-4 text-center">' . $task->description . '</td>
                                    <td class="py-2 px-4 text-center">' . $task->assigned_to . '</td>
                                    <td class="py-2 px-4 text-center">' . $task->due_date . '</td>
                                    <td class="py-2 px-4 text-center">' . $task->project->title . '</td>
                                    <td class="py-2 px-4 text-center">
                                        <span class="text-white py-1 px-3 rounded-full text-xs ';
                                        // Priority background color
                                        $output .= $task->priority == 'low' ? 'bg-green-500' : ($task->priority == 'normal' ? 'bg-yellow-500' : 'bg-red-500');
                                        $output .= '">';
                                        // Priority text
                                        $output .= $task->priority == 'low' ? 'Low' : ($task->priority == 'normal' ? 'Normal' : 'High');
                                        $output .= '</span>
                                    </td>
                                    <td class="py-2 px-4 text-center">
                                        <span class="text-white py-1 px-3 rounded-full text-xs ';
                                        // Status background color
                                        $output .= $task->status == 'pending' ? 'bg-yellow-500' : ($task->status == 'in_progress' ? 'bg-blue-500' : 'bg-green-500');
                                        $output .= '">';
                                        // Status text
                                        $output .= $task->status == 'pending' ? 'Pending' : ($task->status == 'in_progress' ? 'Progress' : 'Completed');
                                        $output .= '</span>
                                    </td>
                                    <td class="py-2 px-4 text-center">
                                        <a href="' . url('/tasks/edit', ['id' => $task->id]) . '" class="py-1 px-1 rounded-full text-xs">
                                            <i class="fas fa-edit text-blue-500"></i>
                                        </a>
                                        <a href="' . url('/tasks/show', ['id' => $task->id]) . '" class="py-1 px-1 rounded-full text-xs">
                                            <i class="fas fa-eye text-gray-500"></i>
                                        </a>
                                        <form action="' . url('/tasks/destroy', ['id' => $task->id]) . '" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                            <button type="submit" class="py-1 px-1 rounded-full text-xs delete-btn">
                                                <i class="fas fa-trash-alt text-red-500"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>';
                }
            } else {
                $output = '<tr><td colspan="8" class="text-center bg-red-800">No tasks found.</td></tr>';
            }

            return response()->json($output);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::withTrashed()->find($id);

        if ($task) {
            $task->forceDelete();
            return redirect()->route('tasks')->with('success', 'Tâche supprimée avec succès.');
        } else {
            return redirect()->route('tasks')->with('error', 'Tâche non trouvée.');
        }

    }

    public function archive($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
            return redirect()->route('tasks')->with('success', 'Tâche supprimée avec succès.');
        } else {
            return redirect()->route('tasks')->with('error', 'Tâche non trouvée.');
        }
    }

}
