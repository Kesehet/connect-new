@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">

        @include('admin.includes.sidebar')

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Admin Manager</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('appraisal')}}">Appraisal</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Appraisal</h5>
                            </div>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td class="capitalize">{{$user->first_name}} {{$user->last_name}}</td>
                                        <td>
                                             @if ($appraisalcnt[$user->id]['orgcount'] == 5)
                                             <a href="{{route('appraisal.create','uid='.$user->id)}}" class="btn btn-sm btn-success">View Appraisal</a> 
                                             @else
                                             <button type="button" name="button_x" class="btn btn-sm btn-dark" disabled="disabled">View Appraisal</button>
                                             @endif
                                             
                                             @if ($appraisalcnt[$user->id]['funcount'] == 5)
                                             <a href="{{route('appraisal.createfun','uid='.$user->id)}}" class="btn btn-sm btn-success">View Fun Goal</a> 
                                             @endif
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
            @include('admin.includes.footer')   
        </div>
    </div>

    @endsection
    
    
    