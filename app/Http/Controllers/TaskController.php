<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Controller\User;
use Illuminate\Support\Facades\DB;
use App\Models\Subtask;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = $this->getUserRole($userId);
        
        if ($userRole == 'admin') {
            $tasks = $this->getTasksForAdmin();
            $userlist = $this->getUserListForAdmin();
        } elseif ($userRole == 'manager') {
            $UserIds = $this->getManagerUserIds($userId);
            $tasks = $this->getTasksForManager($UserIds);
            $userlist = $this->getUserListForManager($UserIds);
        } else {
            $userlist = [];
            $tasks = $this->getUserTasks($userId);
        }
    
        $tasksWithSubtasks = [];
        foreach ($tasks as $task) {
            $task->subtasks = $this->getSubtasksForTask($task->id);
            $tasksWithSubtasks[] = $task;
        }
        
        $tasks = $tasksWithSubtasks;
        return view('admin.tasks.index', compact('tasks', 'userlist'));
    }
    

    private function getUserRole($userId)
    {
        $userRole = DB::table('users')->where('id', $userId)->value('role');
        return $userRole;
    }
    
    private function getTasksForAdmin()
    {
        $tasks = DB::table('tasks')->orderBy('created_at', 'DESC')->paginate(20);
        return $tasks;
    }

    private function getUserListForAdmin()
    {
        $userlist = DB::table('users')->pluck(DB::raw("CONCAT(first_name, ' ', last_name) AS username"), 'id');
        return $userlist;
    }

    private function getManagerUserIds($userId)
    {
        $UserIds = DB::table('users')->where('manager', 'your_manager_name')->pluck('id');
        $UserIds[] = $userId;
        return $UserIds;
    }

    private function getTasksForManager($userIds)
    {
        $tasks = DB::table('tasks')->whereIn('user_id', $userIds)->orderBy('created_at', 'DESC')->paginate(20);
        return $tasks;
    }

    private function getUserListForManager($userIds)
    {
        $userlist = DB::table('users')
            ->whereIn('id', $userIds)
            ->pluck(DB::raw("CONCAT(first_name, ' ', last_name) AS username"), 'id');
        return $userlist;
    }

    private function getUserTasks($userId)
    {
        $tasks = DB::table('tasks')->where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(20);
        return $tasks;
    }
    private function getSubtasksForTask($taskId)
    {
        $subtasks = DB::table('subtasks')->where('task_id', $taskId)->get();
        return $subtasks;
    }

    public function create()
    {
        if (Auth::user()->role == 'employee' ) {
            Toastr::error('You are not authorized to create tasks!', 'Unauthorized');
            return redirect()->route('admin.tasks.index');
        }
        
        return view('admin.tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

    
        $user_id = Auth::user()->id;
        

        $task = new Task([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $user_id,
        ]);
        $task->save();
        
        
        foreach ($request->input("subtask_name") as $tasker){
            $taskNow = new Subtask([
                'name' => $tasker,
                'description' => $tasker,
                'status' => 'To Do',
                'user_id' => Auth::id(),
                'task_id' => $task->id,
            ]);
            $taskNow->save();
        }
    
        Toastr::success('Task created successfully!', 'Success');
        return redirect()->route('tasks.index');
    }
    

    public function show(Task $task)
    {
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        
        
            $task->subtasks = $this->getSubtasksForTask($task->id);
        
        
         
        return view('admin.tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);

    $userRole = Auth::user()->role;

    // Check if user is admin or manager
    if ($userRole === 'admin' || $userRole === 'manager') {
        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    }

    // Update subtasks for the user
    if ($userRole === 'employee') {
        $subtasks = $request->input('subtask_name', []);
        $existingSubtasks = $task->subtasks->pluck('id')->toArray();

        // Delete removed subtasks
        $subtasksToDelete = array_diff($existingSubtasks, $subtasks);
        Subtask::whereIn('id', $subtasksToDelete)->delete();

        // Update or create subtasks
        foreach ($subtasks as $index => $subtask) {
            Subtask::updateOrCreate(
                ['id' => $subtask],
                [
                    'name' => $request->input('subtask_name.' . $index),
                    'description' => $request->input('subtask_name.' . $index),
                    'status' => $task->status,
                    'user_id' => Auth::id(),
                    'task_id' => $task->id,
                ]
            );
        }
    }

    Toastr::success('Task updated successfully!', 'Success');
    return redirect()->route('tasks.index');
}


    public function destroy(Task $task)
    {
        $task->delete();

        Toastr::success('Task deleted successfully!', 'Deleted');
        return redirect()->route('tasks.index');
    }

    public function createSubtask(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $subtask = new Subtask([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => 'To Do',
            'user_id' => Auth::id(),
            'task_id' => $task->id,
        ]);

        $subtask->save();

        Toastr::success('Subtask created successfully!', 'Success');
        return redirect()->route('admin.tasks.edit', $task->id);
    }

    public function updateSubtask(Request $request, Task $task, Subtask $subtask)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $subtask->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        Toastr::success('Subtask updated successfully!', 'Success');
        return redirect()->route('tasks.index', $task->id);
    }

    public function deleteSubtask(Task $task, Subtask $subtask)
    {
        $subtask->delete();

        Toastr::error('Subtask deleted successfully!', 'Deleted');
        return redirect()->route('admin.tasks.edit', $task->id);
    }

    public function updateSubtaskStatus(Request $request, Subtask $subtask)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed',
        ]);

        $subtask->update([
            'status' => $request->input('status'),
        ]);

        return response()->json(['message' => 'Subtask status updated successfully'], Response::HTTP_OK);
    }
}
