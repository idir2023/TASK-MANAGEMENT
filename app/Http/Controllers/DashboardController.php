<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request; // Ensure you are using Laravel's Request class
use Yajra\DataTables\DataTables; // Include this if using Yajra DataTables


class DashboardController extends Controller
{


    public function index(Request $request)
    {
        $Tasks = Task::all();
        $Projects = Project::all();
        $Employers = Employer::all();

        if ($request->Ajax()) {
            $Querys = Task::join('projects as P', 'P.id', '=', 'tasks.project_id')
                ->join('employers as E', 'E.id', '=', 'P.employer_id')
                ->select(
                    'P.title as project_title',
                    'E.name as name',
                    'E.company_name as company_name',
                    'E.avatar as avatar',
                    'tasks.title as task_title',
                    'tasks.status as task_status'
                )
                ->get();

            return DataTables::of($Querys)
                ->addIndexColumn()
                ->addColumn('employer', function ($row) {
                    $img = '<img class="shrink-0 mr-2 sm:mr-3 rounded-full" width="36" height="36" src="' . asset('storage/' . $row->avatar) . '" alt="Avatar">';
                    return '<div class="flex items-center">' . $img . '<div class="text-slate-800 dark:text-slate-100">' . $row->name . '</div></div>';
                })
                ->addColumn('status', function ($row) {
                    $statusClass = $row->task_status == 'pending' ? 'bg-yellow-500' : ($row->task_status == 'in_progress' ? 'bg-blue-500' : 'bg-green-500');
                    $statusText = $row->task_status == 'pending' ?  __('messages.pending')  : ($row->task_status == 'in_progress' ? __('messages.in_progress') : __('messages.completed') );
                    return '<div class="text-center text-emerald-500"><span class="text-white py-1 px-3 rounded-full text-xs ' . $statusClass . '">' . $statusText . '</span></div>';
                })


                ->addColumn('project_title', function ($row) {
                    return '<div class="text-center">' . $row->project_title . '</div>';
                })
                ->addColumn('task_title', function ($row) {
                    return '<div class="text-center">' . $row->task_title . '</div>';
                })

                ->rawColumns(['employer','task_title','project_title', 'status'])
                ->make(true);
        }


        return view('pages.dashboard.dashboard', compact('Tasks', 'Projects', 'Employers'));
    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        return view('pages/dashboard/fintech');
    }
}
