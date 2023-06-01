@extends('admin.layout.master')

@section('content')

@include('admin.includes.sidebar')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit Task</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Task</h4>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="form-horizontal">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Task Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $task->name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 text-right control-label col-form-label">Task Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" id="description" required>{{ $task->description }}</textarea>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Subtasks</h4>
                            <div id="subtasks-container">
                                @foreach ($task->subtasks as $subtask)
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Subtask Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="subtask_name[]" class="form-control" value="{{ $subtask->name }}" required>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" onclick="remSubtask(this)" class="btn btn-danger btn-sm remove-subtask"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Subtask Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="subtask_description[]" class="form-control" required>{{ $subtask->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Assigned To</label>
                                    <div class="col-sm-9">
                                        <select name="subtask_assigned_to[]" class="select2 form-control" multiple="multiple" style="width: 100%;" required>
                                            @foreach ($userList as $userId => $username)
                                                <option value="{{ $userId }}" <?php echo ($userId == $subtask->assigned_to ? "selected":"" ); ?>>{{ $username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="button" onclick="addSubtask()" class="btn btn-success btn-sm add-subtask"><i class="fas fa-plus"></i> Add Subtask</button>
                                </div>
                                <script>
                                    function addSubtask() {
                                        var subtaskHtml = `
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Subtask Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="subtask_name[]" class="form-control" required>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" onclick="remSubtask(this)" class="btn btn-danger btn-sm remove-subtask"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Assigned To</label>
                                            <div class="col-sm-9">
                                                <select name="subtask_assigned_to[]" class="select2 form-control" multiple="multiple" style="width: 100%;" required>
                                                    @foreach ($userList as $userId => $username)
                                                        <option value="{{ $userId }}">{{ $username }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        `;
                                        $('#subtasks-container').append(subtaskHtml);
                                    }

                                    // Remove subtask
                                    function remSubtask(e) {
                                        $(e).closest('.form-group').remove();
                                    }
                                </script>
                            </div>
                            
                            <div class="border-top">
                                <p style="color:red;">Note: All Subtasks will be set to To Do</p>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-dark">Update Task</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.footer')

@endsection

@section('scripts')
<!-- Include select2 library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // Initialize select2
    $('.select2').select2();
</script>
@endsection
