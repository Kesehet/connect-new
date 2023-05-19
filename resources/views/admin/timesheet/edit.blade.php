@extends('admin.layout.master')

@section('content')

    @include('admin.includes.sidebar')

    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Edit Timesheet</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('timesheet') }}">Timesheet</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Timesheet</li>
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
                        <form action="{{ route('timesheet.update', $timesheet->id) }}" method="post" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <h4 class="card-title">Edit Timesheet</h4>
                                <div class="form-group row">
                                    <label for="timesheet_date" class="col-sm-3 text-right control-label col-form-label">Timesheet Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="timesheet_date" class="form-control" id="timesheet_date" value="{{ $timesheet->timesheet_date }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Timesheet Details</label>
                                    <div class="col-sm-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Time (hours)</th>
                                                    <th>Time (minutes)</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($timesheet->timesheetdetails as $timesheetdetail)
                                                    <tr>
                                                        <td>
                                                            <input type="number" name="hours[]" class="form-control" value="{{ floor($timesheetdetail->working_mintus / 60) }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="mintus[]" class="form-control" value="{{ $timesheetdetail->working_mintus % 60 }}" required>
                                                        </td>
                                                        <td>
                                                            <textarea name="comments[]" class="form-control" required>{{ $timesheetdetail->comments }}</textarea>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Update Timesheet</button>
                                    <a href="{{ route('timesheet') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.includes.footer')

@endsection
