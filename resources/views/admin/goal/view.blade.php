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

            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Goal Management</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('goal')}}">Goal</a></li>
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
                                
                                <h4 class="card-title">{{$goal->order_no}}.</h4>
                                
                                <div class="form-group  row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Goal Title</label>
                                    <div class="col-sm-8">
                                        {{$goal->title}}
                                    </div>
                                </div>
                                
                                 <div class="after-add-more">
                                    <div class="form-group  row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Goal Description</label>
                                        <div class="col-sm-8">
                                             {!!  @nl2br($goal->description ?? '') !!}
                                        </div>
                                    </div>
                                 </div>
                                                                
                                
                                
                            </div>
                        
                            <div class="border-top" style="margin-bottom: 10px;">
                                <div class="card-body">
                                    <a class="btn btn-success" type="button" style="float: right; margin-left: 5px;" href="{{ URL::previous() }}"><i class="glyphicon glyphicon-plus"></i> Back</a>
                                </div>
                            </div>
                            
                        </form>
                        
                        
                        
                    </div>
                </div>
            </div>
            
            
            
        </div>
          
            
        @include('admin.includes.footer')   
        

    </div>

@endsection

@section('js')


@endsection