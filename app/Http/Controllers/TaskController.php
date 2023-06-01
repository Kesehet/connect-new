<?php

namespace App\Http\Controllers;

use App\Task;
use App\Models\Subtask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Retrieves tasks and user list based on user's role.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = $this->getUserRole($userId);
        $userList = $this->getUserListForEmployee();
        if ($userRole === 'admin') {
            $tasks = $this->getTasksForAdmin();
            $userList = $this->getUserListForAdmin();
        } elseif ($userRole === 'manager') {
            $userIds = $this->getManagerUserIds($userId,$managerName = Auth::user()->name);
            $tasks = $this->getTasksForManager($userIds);
            $userList = $this->getUserListForManager($userIds);
        } else {
            $tasks = $this->getUserTasks($userId);
        }

        $tasksWithSubtasks = [];
        foreach ($tasks as $task) {
            $task->subtasks = $this->getSubtasksForTask($task->id);

            // Filter subtasks based on user role
            if ($userRole == 'employee') {
                $task->subtasks = $task->subtasks->where('assigned_to', $userId);
            }

            $tasksWithSubtasks[] = $task;
        }

        $tasks = $tasksWithSubtasks;
        return view('admin.tasks.index', compact('tasks', 'userList'));
    }
    public function getUserListForEmployee(){
        
        return $this->getUserListForAdmin();
    }
    /**
     * Retrieves the role of a user given their user ID.
     *
     * @param int $userId the ID of the user whose role to retrieve.
     * @return string the role of the user.
     */
    private function getUserRole($userId)
    {
        $userRole = User::where('id', $userId)->value('role');
        return $userRole;
    }

    private function getTasksForAdmin()
    {
        $tasks = Task::orderBy('created_at', 'DESC')->paginate(20);
        return $tasks;
    }

    private function getUserListForAdmin()
    {
        $userList = User::query()
            ->selectRaw("CONCAT(first_name, ' ', last_name) AS username, id")
            ->pluck('username', 'id');

        return $userList;
    }


    private function getManagerUserIds($userId, $managerName)
    {
        $managerName = 'your_manager_name';
        $userIds = User::where('manager', $managerName)->pluck('id')->toArray();
        $userIds[] = $userId;
        return $userIds;
    }

    private function getTasksForManager($userIds)
    {
        $tasks = Task::whereIn('user_id', $userIds)->orderBy('created_at', 'DESC')->paginate(20);
        return $tasks;
    }

    private function getUserListForManager($userIds)
    {
        $userList = User::whereIn('id', $userIds)
            ->pluck(DB::raw("CONCAT(first_name, ' ', last_name) AS username"), 'id');
        return $userList;
    }

    private function getUserTasks($userId)
    {
        
        $returnList = [];
        $tasks= Task::orderBy('created_at', 'DESC')->get();
        for ($i=0; $i < count($tasks); $i++) { 
            $subtask = $tasks[$i]->subtasks;
            
            $toTest =  $subtask->where('assigned_to', $userId)->where("status","!=","Approved");
            if(count($toTest) > 0 && $toTest != null){
                array_push($returnList, $tasks[$i]);
            }
        }
        return $returnList;
    }

    private function getSubtasksForTask($taskId)
    {
        $subtasks = Subtask::where('task_id', $taskId)->get();
        return $subtasks;
    }

    public function create()
    {
        if (Auth::user()->role === 'employee') {
            return redirect()->route('admin.tasks.index')->withErrors('You are not authorized to create tasks!');
        }

        $userList = [];
        if (Auth::user()->role === 'admin') {
            $userList = $this->getUserListForAdmin();
        } elseif (Auth::user()->role === 'manager') {
            $userId = Auth::user()->id;
            $userIds = $this->getManagerUserIds($userId,Auth::user()->name);
            $userList = $this->getUserListForManager($userIds);
        }

        return view('admin.tasks.create', compact('userList'));
    }
    /**
     * Store a newly created task in storage.
     *
     * @param Request $request The HTTP request instance.
     * @throws Some_Exception_Class If something goes wrong.
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $userId = Auth::user()->id;
        $createdBy = Auth::user()->role === 'admin' ? $userId : null;

        $task = Task::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $userId,
            'created_by' => $createdBy,
        ]);

        foreach ($request->input('subtask_name', []) as $index => $subtaskName) {
            $assignedTo = intval($request->input('subtask_assigned_to.' . $index));

            Subtask::create([
                'name' => $subtaskName,
                'description' => $subtaskName,
                'status' => 'To Do',
                'user_id' => Auth::id(),
                'task_id' => $task->id,
                'created_by' => Auth::id(),
                'assigned_to' => $assignedTo,
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, Task $task)
{
    // Validate subtasks which will be an array of subtask names and descriptions along with their statuses
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'subtask_name' => 'required',
        'subtask_assigned_to' => 'required',
        "subtask_description" => "required",
    ]);

    $userRole = Auth::user()->role;

    
        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    

    
        $subtasks = $request->input('subtask_name', []);
        $existingSubtasks = $task->subtasks->pluck('id')->toArray();

        // Delete removed subtasks
        $subtasksToDelete = array_diff($existingSubtasks, $subtasks);
        Subtask::whereIn('id', $subtasksToDelete)->delete();

        // Update or create subtasks
        foreach ($subtasks as $index => $subtaskId) {
            $subtaskName = $request->input('subtask_name.' . $index);
            $subtaskDescription = $request->input('subtask_description.' . $index);
            if($subtaskDescription == null){$subtaskDescription = $subtaskName;}
            $subtaskStatus = $request->input('subtask_status.' . $index);
            if($subtaskStatus == null){$subtaskStatus = 'To Do';}
            $subtaskAssignedTo = $request->input('subtask_assigned_to.' . $index);

            Subtask::updateOrCreate(
                ['id' => $subtaskId],
                [
                    'name' => $subtaskName,
                    'description' => $subtaskDescription,
                    'status' => $subtaskStatus,
                    'assigned_to' => $subtaskAssignedTo,
                    'user_id' => Auth::id(),
                    'created_by' => Auth::id(),
                    'task_id' => $task->id,
                ]
            );
        }
    

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
}


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
    
    public function edit(Task $task){
        //write this like create function 
        if (Auth::user()->role === 'employee') {
            return redirect()->route('admin.tasks.index')->withErrors('You are not authorized to create tasks!');
        }

        $userList = [];
        if (Auth::user()->role === 'admin') {
            $userList = $this->getUserListForAdmin();
        } elseif (Auth::user()->role === 'manager') {
            $userId = Auth::user()->id;
            $userIds = $this->getManagerUserIds($userId,Auth::user()->name);
            $userList = $this->getUserListForManager($userIds);
        }

        return view('admin.tasks.edit', compact('userList','task'));
    }

    public function createSubtask(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $subtask = Subtask::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => 'To Do',
            'user_id' => Auth::id(),
            'task_id' => $task->id,
        ]);

        return redirect()->route('admin.tasks.edit', $task->id)->with('success', 'Subtask created successfully!');
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

        return redirect()->route('tasks.index', $task->id)->with('success', 'Subtask updated successfully!');
    }

    public function deleteSubtask(Task $task, Subtask $subtask)
    {
        $subtask->delete();

        return redirect()->route('admin.tasks.edit', $task->id)->with('error', 'Subtask deleted successfully!');
    }

    public function updateSubtaskStatus(Request $request, Subtask $subtask)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed,Approved',
        ]);
        $subtask->update([
            'status' => $request->input('status'),
        ]);

        return response()->json(['message' => 'Subtask status updated successfully'], Response::HTTP_OK);
    }
}
