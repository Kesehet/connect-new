@extends('admin.layout.master')

@section('content')

    @include('admin.includes.sidebar')

@section('content')
<div class="page-wrapper">
    
    
    
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Task Management</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('leave')}}">Leave</a></li>
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
                            <h4 class="card-title">Tasks List</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th >S.N</th>
                                            <th >Task Name</th>
                                            <th >Description</th>
                                            <th >Status</th>
                                            <th >Assigned To</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tasks as $task)
                                        <tr>
                                                <th>{{ $task->id }}</th>
                                                <td>{{ $task->name }}</td>
                                                <td>{{ $task->description }}</td>
                                                <td>{{ $task->status }}</td>
                                                <td>{{ $task->user_id }}</td>
                                            <td>
                                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                        



@include('admin.includes.footer')   
</div>

@endsection
