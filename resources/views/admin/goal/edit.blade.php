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
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('goal.create')}}">Goal</a></li>
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
                        <form action="{{route('goal.update',$goal -> id)}}" method="post" class="form-horizontal">
                            @csrf
                            
                            
                            <div class="card-body">
                                <h4 class="card-title">{{$goal->order_no}}.</h4>
                                
                                <div class="form-group required row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Goal Title</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="title" class="form-control" id="title" required="required" value="{{$goal->title}}">
                                    </div>
                                </div>
                                
                                 <div class="after-add-more">
                                    <div class="form-group required row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Goal Description</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" name="description" class="form-control" placeholder="Description" required>{{$goal->description}}</textarea>
                                        </div>
                                        
                                    </div>
                                    
                                 </div>
                                  
                                @if($goal->goal_type != 1)
                                <div class="form-group required row" style="display: none;">
                                    <label for="gender" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select type="text" name="status" class="form-control" id="status" value="" required="">
                                            <option value="0">Pending</option>
                                            @can('isAdmin') 
                                            <option value="2">Approved</option>
                                            @endcan
                                            @can('isEmployee')
                                            @if($goal->status == 0)
                                            <option value="1">Submitted</option>
                                            @endif
                                            @endcan
                                        </select>
                                    </div>
                                </div>
                                @endif
                                
                                
                               
                                
                                
                                
                                

                                
                                
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-dark">Save</button>
                                    <!--<button class="btn btn-success add-more" type="button" style="float: right;"><i class="glyphicon glyphicon-plus"></i> Add More</button>-->
                                </div>
                            </div>
                        </form>
                        
                        <!--<div class="copy hide">
                            <div class="control-group-only"><hr>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Goal Time</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="hours[]" class="form-control" id="hours" placeholder="Hours" step="1" min="0" max="8" required="required">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" name="mintus[]" class="form-control" id="mintus" placeholder="Minutes" step="10" min="0" max="50" required="required">
                                    </div>
                                </div>
                                <div class="form-group required row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea type="text" name="comments[]" class="form-control" placeholder="Description" required></textarea>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group-btn" style="margin-top: 22px;"> 
                                            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                         </div>
                                    </div>
                                </div> 

                            </div>
                        </div>-->
                        
                    </div>
                </div>
            </div>
            
            
            
        </div>
          
            
        @include('admin.includes.footer')   
        

    </div>

@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function() {

      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group-only").remove();
      });

    });

</script>
    
@endsection