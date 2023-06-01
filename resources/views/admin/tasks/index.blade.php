@extends('admin.layout.master')

@section('content')

@include('admin.includes.sidebar')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Task Management</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('leave') }}">Tasks</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?>">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">To Do</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?>">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">In Progress</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?>">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Completed</h4>
                    </div>
                </div>
            </div>
            @if(Auth::user()->role != 'employee')
            <div class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?>">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Approved</h4>
                    </div>
                </div>
            </div>
            @endif
            <style>
                .ToDo .draggable:hover {
                    background-color: grey;
                    color:white;
                }
                .InProgress .draggable:hover {
                    background-color: yellow;
                    color:black;
                }
                .Completed .draggable:hover {
                    background-color: green;
                    color:black;
                }
                .subtaskDescript {
                    display: none;
                }
                .draggable:hover .subtaskDescript {
                    display: block;
                }
                .editsubtask{
                    font-size:8px;
                }
                .hider{
                    opacity: 0.3;
                }
                .hider:hover{
                    opacity: 0.9;
                }
            </style>
            @foreach($tasks as $task)
                <div class="col-md-12">
                    <div class="card" style="background:transparent;">
                        <div class="card-body">
                            <h4 class="card-title">
                                <button class="btn btn-success hider"><i class="minimize-icon fa fa-angle-down" onclick="toggleTask(this)"></i></button>
                                {{ $task->name }} 
                            </h4>
                            
                            <h6>{{ $task->description }}</h6>
                            @if(Auth::user()->role != 'employee')
                            <div class="row">
                            <form class="col-md-2" action="{{ route('tasks.edit', $task->id) }}" method="GET" >
                                @csrf
                                <button type="submit" class="btn btn-primary editsubtask">Edit Task</button>
                            </form>
                            <form class="col-md-2" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class=" btn btn-danger editsubtask">Delete Task</button>
                            </form>

                            </div>
                            
                            
                            @endif
                            <div class="row task-content minimized">
                                
                                
                                <div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> ToDo" style="background:#00000038;padding:1%;" ondrop="handleDrop(event, 'ToDo')" ondragover="handleDragOver(event)">
                                    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'To Do')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    <p>{{ $subtask->description }}</p>
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:8px;">Assigned to {{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:8px;">Assigned by {{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="convertToForm({{ $task->id }},{{ $subtask->id }})" href="#" class="btn btn-primary editsubtask">Edit SubTask</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> InProgress" style="background:#ffff0038;padding:1%;" ondrop="handleDrop(event, 'InProgress')" ondragover="handleDragOver(event)">
                                    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'In Progress')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    <p>{{ $subtask->description }}</p>
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:8px;">Assigned to {{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:8px;">Assigned by {{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="convertToForm({{ $task->id }},{{ $subtask->id }})" href="#" class="btn btn-primary editsubtask">Edit SubTask</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                
                                <div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> Completed" style="background:#33ff0038;padding:1%;" ondrop="handleDrop(event, 'Completed')" ondragover="handleDragOver(event)">
                                    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'Completed')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    <p>{{ $subtask->description }}</p>
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:8px;">Assigned to {{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:8px;">Assigned by {{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="convertToForm({{ $task->id }},{{ $subtask->id }})" href="#" class="btn btn-primary editsubtask">Edit SubTask</button>
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @if(Auth::user()->role != 'employee')
                                <div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> Completed" style="background:#33ff007d;padding:1%;" ondrop="handleDrop(event, 'Approved')" ondragover="handleDragOver(event)">
                                    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'Approved')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    <p>{{ $subtask->description }}</p>
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:8px;">Assigned to {{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:8px;">Assigned by {{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="convertToForm({{ $task->id }},{{ $subtask->id }})" href="#" class="btn btn-primary editsubtask">Edit SubTask</button>
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            
                                This task was created by :- <b>{{$userList[$task->created_by]}}</b>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
<script>
    function toggleTask(element) {
       
        if(element.parentElement.className.includes('btn-success')){
            element.parentElement.className = element.parentElement.className.replace('btn-success','btn-danger');
            element.className = element.className.replace('fa-angle-down', 'fa-angle-up');
        }
        else{
            element.className = element.className.replace('fa-angle-up', 'fa-angle-down');
            element.parentElement.className = element.parentElement.className.replace( 'btn-danger','btn-success');
        }
        
       
        
        $(element).closest('.card-body').find('.task-content').toggleClass('minimized');
    }
</script>
<style>
    .task-content.minimized {
        display: none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script>
    function handleDragStart(event) {
        event.dataTransfer.setData('text/plain', event.target.id);
    }

    function handleDragOver(event) {
        event.preventDefault();
    }

    ALL_STATUSES = {
        "InProgress":"In Progress","Completed":"Completed","ToDo":"To Do","Approved":"Approved"
    }

    function handleDrop(event, status) {
        event.preventDefault();
        const cardId = event.dataTransfer.getData('text/plain');

        const card = document.getElementById(cardId);
        const targetColumn = event.currentTarget;
        console.log(cardId);
        console.log(targetColumn.getAttribute("taskid"));
        if(card.getAttribute("taskid") != targetColumn.getAttribute("taskid")){
            return;
        }
        updateSubtaskStatus(parseInt(cardId.match(/\d+/)[0]),ALL_STATUSES[status])
        

        // Move the card to the target column
        targetColumn.appendChild(card);

        // Update the status of the card
        const cardStatus = card.parentNode.classList[1]; // Assuming the second class represents the status
        if (cardStatus !== status) {
            card.parentNode.classList.remove(cardStatus);
            card.parentNode.classList.add(status);
        }
    }

    function updateSubtaskStatus(subtaskId, newStatus) {
        const url = `subtasks/${subtaskId}/status`;
        console.log(newStatus);
        const requestOptions = {    
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({ status: newStatus }),
        };

        fetch(url, requestOptions)
            .then(response => {
            if (!response.ok) {
                throw new Error('Error updating subtask status');
            }
            return response.json();
            })
            .then(data => {
            // Handle the response data, if needed
            console.log(data.message);
            })
            .catch(error => {
            // Handle the error, if any
            console.error(error);
            });
        }
        function getCsrfToken() {
            return "{{ csrf_token() }}";
        }

</script>

<script>
    function convertToForm(task,subtaskId) {
        const draggableCard = document.getElementById(`draggable_${subtaskId}_card`);
        const subtaskName = draggableCard.querySelector('p').textContent;
        const subtaskDescription = draggableCard.querySelector('.subtaskDescript p').textContent;

        const form = document.createElement('form');
        form.setAttribute('id', `form_${subtaskId}`);
        form.setAttribute('action', `tasks/${task}/subtasks/${subtaskId}`);
        form.setAttribute('method', 'POST');

        const csrfTokenInput = document.createElement('input');
        csrfTokenInput.setAttribute('type', 'hidden');
        csrfTokenInput.setAttribute('name', '_token');
        csrfTokenInput.setAttribute('value', '{{ csrf_token() }}');

        const methodInput = document.createElement('input');
        methodInput.setAttribute('type', 'hidden');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'POST');

        const nameLabel = document.createElement('label');
        nameLabel.textContent = 'Name:';
        nameLabel.className = "col-sm-12  control-label col-form-label";

        const nameInput = document.createElement('input');
        nameInput.setAttribute('type', 'text');
        nameInput.setAttribute('name', 'name');
        nameInput.className = "form-control";
        nameInput.setAttribute('value', subtaskName);

        const descriptionLabel = document.createElement('label');
        descriptionLabel.textContent = 'Description:';
        descriptionLabel.className = "col-sm-12  control-label col-form-label";

        const descriptionInput = document.createElement('textarea');
        descriptionInput.setAttribute('type', 'text');
        descriptionInput.setAttribute('name', 'description');
        descriptionInput.className = "form-control";
        descriptionInput.innerHTML = subtaskDescription;

        const submitButton = document.createElement('button');
        submitButton.setAttribute('type', 'submit');
        submitButton.className = "btn btn-success"
        submitButton.textContent = 'Update SubTask';

        form.appendChild(csrfTokenInput);
        form.appendChild(methodInput);
        form.appendChild(nameLabel);
        form.appendChild(nameInput);
        form.appendChild(descriptionLabel);
        form.appendChild(descriptionInput);
        form.appendChild(submitButton);

        draggableCard.innerHTML = '';
        draggableCard.appendChild(form);
    }
</script>