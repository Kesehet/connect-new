@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                    
                    <div class="card-header">Dashboard</div>
                    
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h3 class="card-title capitalize">Hello  Welcome To Thinknyx Connect</h3>
                            </div>
                        </div>

                    </div>
                    
                    

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                    
                    
                </div>
            </div>
        </div>


    </div> 

    @include('admin.includes.footer')   
</div>

@endsection

@section('js')

@endsection
