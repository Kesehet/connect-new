<?php

namespace App\Http\Controllers;

use App\Task;
use App\Models\Subtask;
use App\Models\User;
use App\Models\TaskComment;
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
            $userIds = $this->getManagerUserIds($userId);
            $tasks = $this->getTasksForManager($userIds);
            $userList = $this->getUserListForManager($userIds);
        } else {
            $tasks = $this->getUserTasks($userId);
        }

        $tasksWithSubtasks = [];
        foreach ($tasks as $task) {
            $task->subtasks = $this->getSubtasksForTask($task->id);
            // get all Task comments where task id is equal to task id. order by date desc
            $task->comments = TaskComment::where('task_id', $task->id)->orderBy('created_at', 'DESC')->get();
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
        
        //take auth user id and get that user as userlist array
        return User::query()
            ->selectRaw("CONCAT(first_name, ' ', last_name) AS fullname, id")
            ->pluck('fullname', 'id');

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
            ->selectRaw("CONCAT(first_name, ' ', last_name) AS fullname, id")
            ->pluck('fullname', 'id');

        return $userList;
    }


    private function getManagerUserIds($userId)
    {
        //get the first name and the last name of the manager
        $managerName = User::where('id', $userId)
            ->value('first_name')
            . ' '
            . User::where('id', $userId)
            ->value('last_name');
        
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
        
        $userList = User::whereIn('id', $userIds)->pluck('first_name', 'id')->toArray();
        $ids = array_keys($userList);
        for ($i=0; $i < count($ids); $i++) { 
            $userList[$ids[$i]] = $userList[$ids[$i]] . ' '. User::where('id', $ids[$i])->value('last_name');
        }
        
        
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
            $userIds = $this->getManagerUserIds($userId);
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
        

        $task = Task::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $userId,
            'created_by' => Auth::id(),
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
            'subtask_name.*' => 'required',
            'subtask_description.*' => 'required',
            'subtask_assigned_to.*' => 'required',
        ]);
    
        $userRole = Auth::user()->role;
    
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->save();
    
        $subtaskIds = $request->input('subtask_id', []);
        $subtaskNames = $request->input('subtask_name', []);
        $subtaskDescriptions = $request->input('subtask_description', []);
        $subtaskAssignedTo = $request->input('subtask_assigned_to', []);
    
        // Update or create subtasks
        foreach ($subtaskNames as $index => $subtaskName) {
            $subtaskId = $subtaskIds[$index] ?? null;
            $subtaskDescription = $subtaskDescriptions[$index] ?? $subtaskName ;
            $subtaskAssignedTo = $subtaskAssignedTo[$index];
    
            if ($subtaskId) {
                // Update existing subtask
                $subtask = Subtask::findOrFail($subtaskId);
                $subtask->name = $subtaskName;
                $subtask->description = $subtaskDescription;
                $subtask->status = 'To Do'; // Set status to 'To Do' for updated subtasks
                $subtask->assigned_to = $subtaskAssignedTo;
                $subtask->user_id = Auth::id();
                $subtask->created_by = Auth::id();
                $subtask->task_id = $task->id;
                $subtask->save();
            } else {
                // Create new subtask
                Subtask::create([
                    'name' => $subtaskName,
                    'description' => $subtaskDescription,
                    'status' => 'To Do', // Set status to 'To Do' for new subtasks
                    'assigned_to' => $subtaskAssignedTo,
                    'user_id' => Auth::id(),
                    'created_by' => Auth::id(),
                    'task_id' => $task->id,
                ]);
            }
        }
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }
    
    public function archiveTask(Request $request, Task $task, $archive)
    {
        // Validate subtasks which will be an array of subtask names and descriptions along with their statuses
        
    
        $task->status = "To Do";
        if($archive){
            $task->status = "Archived";
        }
        
        $task->save();
    
        
    
        return redirect()->route('tasks.index')->with('success', 'Task archived successfully!');
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
            $userIds = $this->getManagerUserIds($userId);
            $userList = $this->getUserListForManager($userIds);
        }

        return view('admin.tasks.edit', compact('userList','task'));
    }

    /**
     * Edit a subtask.
     *
     * @param Subtask $subtask subtask to edit
     * @throws Some_Exception_Class if something goes wrong
     * @return view or redirect view on success, redirect on failure
     */
    public function editSubtask(Subtask $subtask){
        
        $subtask->comments = TaskComment::where('subtask_id', $subtask->id)->orderBy('created_at', 'DESC')->get();
        
        if (Auth::user()->role === 'admin') {
            $userList = $this->getUserListForAdmin()->toArray();
        }
        if (Auth::user()->role === 'manager') {
            $userList = $this->getUserListForManager($this->getManagerUserIds(Auth::user()->id));
        }
        
        if(Auth::user()->role === 'employee'){
            $userList = $this->getUserListForEmployee()->toArray();
        }

        $userIds = array_keys($userList);

        
        if (in_array(Auth::id(), $userIds)) {
            return view('admin.tasks.editSubtask', compact('userList', 'subtask'));    
            // Auth::id() exists in $userList
            
        } else {
            // Auth::id() does not exist in $userList
            return redirect()->route('tasks.index')->withErrors('You are not authorized to edit subtasks!');
        }
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

        return redirect()->route('tasks.edit', $task->id)->with('success', 'Subtask created successfully!');
    }

   public function updateSubtask(Request $request, Subtask $subtask)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'task_id' => 'required',
        'assigned_to' => 'required',
        'status' => 'required',
        'comments' => 'nullable',
    ]);

    $subtask->update($validatedData);

    return redirect()->back();
}


    public function deleteSubtask(Task $task, Subtask $subtask)
    {
        $subtask->delete();

        return redirect()->route('tasks.index')->with('error', 'Subtask deleted successfully!');
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
