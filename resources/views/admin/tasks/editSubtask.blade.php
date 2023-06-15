@extends('admin.layout.master')

@section('content')

@include('admin.includes.sidebar')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Task</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subtask</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    


    <div class="container-fluid">

        <div class="row">




            <div class="col-md-12" id="task_box">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$subtask->name}}</h4>
                        @if ($subtask->description != $subtask->name)
                            <p>{{ $subtask->description }}</p>
                        @endif
                        <p>
                        This task was assigned to {{ $userList[$subtask->assigned_to] ?? '' }}
                        @if ($subtask->assigned_to !== $subtask->created_by)
                            and was created by {{ $userList[$subtask->created_by] ?? '' }}
                        @endif
                        </p>
                        <p>
                            <b>Status:</b> {{$subtask->status}}
                        </p>
                        <!-- show edit button to allow user to edit subtask -->
                        @foreach($userList as $userId => $username)
                            @if ($subtask->assigned_to == $userId)
                                <a id="edit-button" class="btn btn-sm btn-success" style="background-color: #ffffff;color: #219864;"><i class="fa fa-pencil-alt" > </i></a>
                                <a class="btn btn-sm btn-danger" style="background-color: #ffffff;color: #dc3545;" href="{{ route('tasks.subtasks.delete', ['task' => $subtask->task_id, 'subtask' => $subtask]) }}" onclick="event.preventDefault(); document.getElementById('delete-subtask-form').submit();">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form id="delete-subtask-form" action="{{ route('tasks.subtasks.delete', ['task' => $subtask->task_id, 'subtask' => $subtask]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @break    
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-12" id="comments_box">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            @foreach ($subtask->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body d-flex align-items-start">
                                    <img src="../../uploads/gallery/{{ $comment->user->image }}" alt="Profile Image" class="rounded-circle mr-3" style="width: 40px; height: 40px;">
                                    <div>
                                        <h6 class="mb-0">{{ $comment->user->first_name }} {{$comment->user->last_name}}</h6>
                                        <p class="mb-0">{{ $comment->comment }}</p>
                                        <!-- Delete comment button only visible to the user -->
                                        @if (Auth::user()->id == $comment->user_id)
                                            <form action="{{ route('task-comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="toDelete" value="{{$comment->id}}">
                                                <button type="submit" class="btn btn-sm btn-link text-danger" onclick="return confirm('Are you sure you want to delete this comment?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <form action="{{ route('task-comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $subtask->task_id }}">
                            <input type="hidden" name="subtask_id" value="{{ $subtask->id }}">
                            <div class="form-group">
                                <label for="new-comment">New Comment</label>
                                <textarea name="comment" id="new-comment" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12" id="edit_box">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Subtask</h4>
                        <form action="{{ route('tasks.subtasks.update', $subtask->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="task_id" id="task_id" class="form-control" value="{{ $subtask->task_id }}" required>
                            <div class="form-group">
                                <label for="name">Subtask Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $subtask->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Subtask Description</label>
                                <textarea name="description" id="description" class="form-control" required>{{ $subtask->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="assigned_to">Assigned To</label>
                                <select name="assigned_to" id="assigned_to" class="form-control" required>
                                    @if (Auth::user()->role != "employee")
                                        @foreach($userList as $userId => $username)
                                            <option value="{{ $userId }}" {{ $subtask->assigned_to == $userId ? 'selected' : '' }}>{{ $username }}</option>
                                        @endforeach
                                    @elseif(Auth::user()->role == "manager")
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</option>
                                        <option value="{{$subtask->assigned_to}}" selected>{{ $subtask->assigned_to }}</option>
                                        <option value="{{$subtask->created_by}}">{{ $subtask->created_by }}</option>
                                    @else
                                        <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="To Do" {{ $subtask->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                                    <option value="In Progress" {{ $subtask->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ $subtask->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    @if(Auth::user()->role == "manager" || Auth::user()->role == "admin")
                                    <option value="Approved" {{ $subtask->status == 'Approved' ? 'selected' : '' }}>Completed</option>
                                    
                                    @endif
                                </select>
                            </div>
                            

                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Update Subtask</button>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                                    
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#edit-button").click(function() {
            $("#edit_box").show();
            $("#task_box").hide();
            $("#comments_box").hide();
            $('html, body').animate({
                scrollTop: $("#edit_box").offset().top
            });

        });
        $('#edit_box').hide();
    });
    
</script>


@endsection
