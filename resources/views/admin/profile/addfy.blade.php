@extends('admin.layout.master')

@section('content')

    @include('admin.includes.sidebar')

    <div class="page-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Manage FY</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('profile.addfy')}}">add fy</a></li>
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
                        <form action="{{route('profile.updatefy')}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">Add FY</h4>
                                
                                <div class="form-group required row">
                                    <label for="new_password" class="col-sm-3 text-right control-label col-form-label">New FY</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="curr_fy" class="form-control" id="curr_fy" placeholder="Enter a FY" value="{{ Session::get('CFY') }}" required readonly="readonly">
                                        <div class="invalid-feedback" style="display: block;">Hints: Add Like 2020-21 etc.</div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.footer')   
    </div>
    <script type="text/javascript">
    </script>

@endsection