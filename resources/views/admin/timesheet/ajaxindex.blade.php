<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Timesheet List</h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Comments</th>
                            <th>Time</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($timesheetdetails as $timesheetdetail)

                            <tr id="row{{$timesheetdetail->id}}">
                                <td>{{ $loop -> index+1 }}</td>
                                <td>{{$timesheetdetail->comments }}</td>
                                <td>{{floor($timesheetdetail->working_mintus/60)}}:{{$timesheetdetail->working_mintus%60}}</td>
                                <td>
                                    <button id="deleteTeetdet" class="btn btn-sm btn-danger" data-url="{{ route('timesheet.ajaxdelete',$timesheetdetail->id) }}">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
