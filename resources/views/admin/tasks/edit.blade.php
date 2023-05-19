@extends('admin.layout.master')

@section('content')

@include('admin.includes.sidebar')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Update Task</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Task</h4>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="form-horizontal">
                            @csrf
                            
                            <div style="display:<?php echo (Auth::user()->role == "admin" ||  Auth::user()->role == "manager" ? "":"none"); ?>;" class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Task Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $task->name }}" required>
                                </div>
                            </div>
                            <div style="display:<?php echo (Auth::user()->role == "admin" ||  Auth::user()->role == "manager" ? "":"none"); ?>;" class="form-group row">
                                <label for="description" class="col-sm-3 text-right control-label col-form-label">Task Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" id="description" required>{{ $task->description }}</textarea>
                                </div>
                            </div>
                            <hr style="display:<?php echo (Auth::user()->role == "admin" ||  Auth::user()->role == "manager" ? "none":""); ?>;">
                            <h4 style="display:<?php echo (Auth::user()->role == "admin" ||  Auth::user()->role == "manager" ? "none":""); ?>;" class="card-title">Subtasks</h4>
                            <div style="display:<?php echo (Auth::user()->role == "admin" ||  Auth::user()->role == "manager" ? "none":""); ?>;" id="subtasks-container">
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
                                @endforeach
                            </div>
                            <div style="display:<?php echo (Auth::user()->role == "admin" ||  Auth::user()->role == "manager" ? "none":""); ?>;" class="form-group row">
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

@endsection
