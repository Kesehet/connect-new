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
                <div class="card shadow-3d">
                    <div class="card-body">
                        <h4 class="card-title"><h4 class="card-title"><?php
                            $randomNumber = rand()%10;
                            if (Auth::user()->role != 'employee') {
                                echo 'To Do';
                            } else {
                                switch ($randomNumber) {
                                    case 0:
                                        echo 'To Do';
                                        break;
                                    case 1:
                                        echo 'Task List';
                                        break;
                                    case 2:
                                        echo 'Pending Tasks';
                                        break;
                                    case 3:
                                        echo 'Upcoming Tasks';
                                        break;
                                    case 4:
                                        echo 'Open Tasks';
                                        break;
                                    case 5:
                                        echo 'Action Items';
                                        break;
                                    case 6:
                                        echo 'Task Queue';
                                        break;
                                    case 7:
                                        echo 'Task Backlog';
                                        break;
                                    case 8:
                                        echo 'Assignments';
                                        break;
                                    case 9:
                                        echo 'Task Assigned';
                                        break;
                                }
                            }
                        ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?>">
                <div class="card shadow-3d">
                    <div class="card-body">
                    <h4 class="card-title"><?php
                        $randomNumber = rand()%8;
                        if (Auth::user()->role != 'employee') {
                            echo 'Ongoing Tasks';
                        } else {
                            switch ($randomNumber) {
                                case 0:
                                    echo 'Work in Progress';
                                    break;
                                case 1:
                                    echo 'In Progress';
                                    break;
                                case 2:
                                    echo 'Ongoing Tasks';
                                    break;
                                case 3:
                                    echo 'Tasks in Motion';
                                    break;
                                case 4:
                                    echo 'In Development';
                                    break;
                                case 5:
                                    echo 'Processing Tasks';
                                    break;
                                case 6:
                                    echo 'Tasks in Progress';
                                    break;
                                case 7:
                                    echo 'Tasks Underway';
                                    break;
                                // Add more cases for additional headings as needed
                            }
                        }
                    ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?>">
                <div class="card shadow-3d">
                    <div class="card-body">
                    <h4 class="card-title"><?php
                        $randomNumber = rand()%11;
                        if (Auth::user()->role != 'employee') {
                            echo 'Awaiting Approval';
                        } else {
                            switch ($randomNumber) {
                                case 0:
                                    echo 'Request Approval';
                                    break;
                                case 1:
                                    echo 'Send for Approval';
                                    break;
                                case 2:
                                    echo 'Pass for Approval';
                                    break;
                                case 3:
                                    echo 'Transmit Approval';
                                    break;
                                case 4:
                                    echo 'Dispatch for Approval';
                                    break;
                                case 5:
                                    echo 'Seek Approval';
                                    break;
                                case 6:
                                    echo 'Request Review';
                                    break;
                                case 7:
                                    echo 'Obtain Consent';
                                    break;
                                case 8:
                                    echo 'Forward for Approval';
                                    break;
                                case 9:
                                    echo 'Submit for Approval';
                                    break;
                                case 10:
                                    echo 'Propose Approval';
                                    break;
                                // Add more cases for additional headings as needed
                            }
                        }
                    ?></h4>
                    </div>
                </div>
            </div>
            @if(Auth::user()->role != 'employee')
            <div class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?>">
                <div class="card shadow-3d">
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
                    background-color: #9bedff;
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
                @if ($task->status == "Archived")
                    @continue
                @endif
                <div class="col-md-12">
                    <div class="card shadow-3d" style="background:transparent;">
                        <div class="card-body">
                            <h4 class="card-title">
                                <button class="btn btn-success hider"><i class="minimize-icon fa fa-angle-down" onclick="toggleTask(this)"></i></button>
                                {{ $task->name }} 
                            </h4>
                            
                            <h6>{{ $task->description }}</h6>
                            @if(Auth::user()->role != 'employee')
                            <div class="row">
                            <form action="{{ route('tasks.edit', $task->id) }}" method="GET" >
			    @csrf
			    <button type="submit" class="btn btn-sm btn-success" style="background-color: #ffffff;color: #219864;"><i class="fa fa-pencil-alt"></i></button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" style="background-color: #ffffff;color: #dc3545;"><i class="fa fa-trash"></i></button>
                            </form>
                            <form action="{{ route('tasks.archive', ['task' => $task, 'archive' => ($task->status == 'Archived' ? 0 : 1)]) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-success" style="background-color: #ffffff;color: #219864;" type="submit"><i class="fa fa-archive"></i></button>
                            </form>

                            </div>
                            
                            
                            @endif
			    <div class="row task-content minimized">
<style>
                                .shadow {
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
}
</style>
                                
                                <div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> ToDo" style="background:#00000038;padding:0%;" ondrop="handleDrop(event, 'ToDo')" ondragover="handleDragOver(event)">
                                    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'To Do')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable shadow" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    @if ($subtask->description != $subtask->name)
                                                        <p>{{ $subtask->description }}</p>
                                                    @endif
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:11px;">Assigned to : {{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:11px;">Assigned by : {{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="window.location.href='{{route('subtasks.editSubtask',$subtask->id)}}'" class="btn btn-success editsubtask" style="font-size:24px;color:white"><i class= "fa fa-comments"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> InProgress" style="background:#ffff0038;padding:0%;" ondrop="handleDrop(event, 'InProgress')" ondragover="handleDragOver(event)">
                                    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'In Progress')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable shadow" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    @if ($subtask->description != $subtask->name)
                                                        <p>{{ $subtask->description }}</p>
                                                    @endif
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:11px;">Assigned to : {{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:11px;">Assigned by : {{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="window.location.href='{{route('subtasks.editSubtask',$subtask->id)}}'" class="btn btn-success editsubtask" style="font-size:24px"><i class= "fa fa-comments"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                
			<div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> Completed" style="background:#33ff0038;padding:0%;" ondrop="handleDrop(event, 'Completed')" ondragover="handleDragOver(event)">
			    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'Completed')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable shadow" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    @if ($subtask->description != $subtask->name)
                                                        <p>{{ $subtask->description }}</p>
                                                    @endif
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:11px;">Assigned to :{{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:11px;">Assigned by :{{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="window.location.href='{{route('subtasks.editSubtask',$subtask->id)}}'" class="btn btn-success editsubtask" style="font-size:24px"><i class="fa fa-comments"></i></button>
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @if(Auth::user()->role != 'employee')
                                <div taskid="{{$task->id}}" class="col-md-<?php echo (Auth::user()->role != 'employee' ? 3:4) ?> Completed" style="background:#33ff007d;padding:0%;" ondrop="handleDrop(event, 'Approved')" ondragover="handleDragOver(event)">
                                    @foreach($task->subtasks as $subtask)
                                        @if($subtask->status === 'Approved')
                                            <div taskid="{{$task->id}}" id="draggable_{{$subtask->id}}_card" class="card draggable shadow" style="padding:10%;" draggable="true" ondragstart="handleDragStart(event)">
                                                <p>{{ $subtask->name }}</p>
                                                <div class="subtaskDescript">
                                                    @if ($subtask->description != $subtask->name)
                                                        <p>{{ $subtask->description }}</p>
                                                    @endif
                                                    @if(Auth::user()->role != 'employee')
                                                        <p style="font-size:11px;">Assigned to : {{ $userList[$subtask->assigned_to] }}</p>
                                                    @endif
                                                    @if(Auth::user()->role == 'employee')
                                                        <p style="font-size:11px;">Assigned by : {{ $userList[$subtask->created_by] }}</p>
                                                    @endif
                                                    <button onclick="window.location.href='{{route('subtasks.editSubtask',$subtask->id)}}'" class="btn btn-success editsubtask" style="font-size:24px"><i class="fa fa-comments"></i></button>
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>
                                
                     Reporter:- <b>{{$userList[$task->created_by]}}</b>

                            
                        </div>
                    </div>
                </div>
            @endforeach
            @if ( Auth::user()->role != 'employee')
                <div class="col-md-12">
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <h4 class="page-title">Archived Tasks</h4>
                    <hr/>
                </div>
                @foreach($tasks as $task)
                    @if ($task->status != "Archived")
                        @continue
                    @endif
                    <div class="col-md-3">
                        <div class="card shadow-3d">
                            <div class="card-body">
                                <h5 class="card-title">{{$task->name}}</h5>
                                <p >{{$task->description}}</p>
                                <p> Creator : {{$userList[$task->created_by]}}</p>
                                <form style="float:right;width:100%;" action="{{ route('tasks.archive', ['task' => $task, 'archive' => ($task->status == 'Archived' ? 0 : 1)]) }}" method="POST">
                                    @csrf
                                    <button style="width:100%;" class=" btn btn-success editsubtask" type="submit"><i class="fas fa-archive"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                
                @endforeach
            @endif
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
.card.shadow-3d {
  position: relative;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;
}

.card.shadow-3d::before,
.card.shadow-3d::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: -1;
  transition: transform 0.3s;
}

.card.shadow-3d::before {
  transform: translate3d(-8px, -8px, -16px);
}

.card.shadow-3d::after {
  transform: translate3d(8px, 8px, -16px);
}

.card.shadow-3d:hover {
  transform: translate3d(0, 0, 0);
}

.card.shadow-3d:hover::before {
  transform: translate3d(-4px, -4px, -8px);
}

.card.shadow-3d:hover::after {
  transform: translate3d(4px, 4px, -8px);
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



