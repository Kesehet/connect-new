<?php

namespace App\Http\Controllers;

use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCommentController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(TaskComment::class, 'comment');
    // }
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'subtask_id' => 'nullable|exists:subtasks,id',
            
            'comment' => 'required|string',
        ]);
        $validatedData['user_id'] = Auth::user()->id;
        $comment = TaskComment::create($validatedData);
        // just redirect back 
        return redirect()->back();
    }

    /**
     * Updates a TaskComment instance with validated data from a Request instance.
     *
     * @param Request $request The HTTP request instance.
     * @param TaskComment $comment The TaskComment instance to update.
     * @throws \Illuminate\Validation\ValidationException If validation fails
     * @return \Illuminate\Http\JsonResponse A JSON response with the updated comment.
     */
    public function update(Request $request, TaskComment $comment)
    {
        $validatedData = $request->validate([
            'task_id' => 'sometimes|required|exists:tasks,id',
            'subtask_id' => 'sometimes|nullable|exists:subtasks,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'comment' => 'sometimes|required|string',
        ]);

        $comment->update($validatedData);

        return response()->json(['message' => 'Comment updated successfully', 'comment' => $comment]);
    }

/**
 * Deletes the given TaskComment object from the database and redirects back.
 *
 * @param TaskComment $comment The TaskComment object to delete
 * @throws -
 * @return Illuminate\Http\RedirectResponse
 */
public function destroy(Request $request,TaskComment $comment)
{
    
    $comment = TaskComment::where('id',$_POST["toDelete"])->get()->first();
    
    if(Auth::user()->id != $comment->user_id){
        return redirect()->back();
    }
    TaskComment::destroy($_POST["toDelete"]);
    
    return redirect()->back();
}
}
