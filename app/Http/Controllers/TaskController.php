<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if(Auth::user()->role=='admin') {
           $tasks = Task::orderBy('created_at', 'DESC')->paginate(20);
           $userlist = User::select(DB::raw("CONCAT(first_name,' ',last_name) AS username"),'id')->pluck('username', 'id');
        }elseif(Auth::user()->role=='manager'){
           $UserIds = Request()->session()->get('AssIdsArr'); 
           $UserIds[] = Auth::id();
           $tasks = Task::whereIn('user_id', $UserIds)->orderBy('created_at', 'DESC')->paginate(20);
           $userlist = User::select(DB::raw("CONCAT(first_name,' ',last_name) AS username"),'id')
                       ->whereIn('id', $UserIds)->pluck('username', 'id');
        }else{
           $userlist = "";
           $tasks =  Auth::user()->tasks()->orderBy('created_at', 'DESC')->paginate(20);
        }
        
        return view('admin.tasks.index',compact('tasks','user','userlist'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Task::create($request->all());

        Toastr::success('Task created successfully!', 'Success');
        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('admin.tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $task->update($request->all());

        Toastr::success('Task updated successfully!', 'Success');
        return redirect()->route('admin.tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        Toastr::error('Task deleted successfully!', 'Deleted');
        return redirect()->route('admin.tasks.index');
    }
}
