@extends('admin.layout.master')

@section('content')

<div id="main-wrapper">
    @include('admin.includes.sidebar')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <!--<h4 class="page-title">Goal Management</h4>-->
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('goal.orgindex')}}">Goal</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('goal.storemutiple')}}" method="post" class="form-horizontal">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">

                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Organizational Goals</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Options</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($goals as $goal)

                                            <tr>

                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$goal->title}}</td>
                                                <td title="{!!strip_tags(htmlspecialchars_decode($goal->description))!!}">{!! Str::words($goal->description, 20, ' ...') !!}</td>
                                                <td>
                                                    @if($goal->status == 0)
                                                    Pending
                                                    @elseif($goal->status == 1)
                                                    Submitted
                                                    @elseif($goal->status == 2)
                                                    Approved
                                                    @elseif($goal->status == 3)
                                                    Returned
                                                    @endif
                                                </td>
                                                <td>

                                                    <a href="{{route('goal.edit',$goal->id)}}" class="btn btn-sm btn-dark" style="float: left;margin-right: 5px;">Edit</a>
                                                    <a href="{{route('goal.view',$goal->id)}}" class="btn btn-sm btn-dark" style="float: left;margin-right: 5px;">View</a>

                                                    <!--<form id="delete-form-{{ $goal->id }}" action="{{route('goal.delete',$goal->id)}}" method="put">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit" onclick="return confirm('Are you sure want to delete?')" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>-->
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $goals->links() }}
                                </div>

                                <div class="border-top" style="padding-top: 5px;">&nbsp;</div>


                            </div>



                        </div>
                    </div>


                </div>
            </div>
        </form>

        @include('admin.includes.footer')   
    </div>
</div>

@endsection