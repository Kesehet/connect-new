


<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                 
                @canany(['isAdmin', 'isManager'])
                <?php /*<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('user')}}" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">User Management</span></a></li>*/ ?>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="{{route('user')}}" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Users</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('user')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Users </span></a></li>
                        @canany(['isAdmin'])
                        <li class="sidebar-item"><a href="{{route('user.create')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add </span></a></li>
                        @endcanany        
                    </ul>
                </li> 
                @endcanany
              
                <?php 
                /* @can('isAdmin')
                {{--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('employee')}}" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Employee Management</span></a></li>--}}
                @endcan */
                /*
                @can('isAdmin')
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">System Management</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('designation')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Designation </span></a></li>
                        <li class="sidebar-item"><a href="{{route('department')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Department </span></a></li>
                        <li class="sidebar-item"><a href="{{route('salary')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
                        {{--<li class="sidebar-item"><a href="{{route('city')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> City </span></a></li>--}}
                        {{--<li class="sidebar-item"><a href="{{route('shift')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Shift </span></a></li>--}}
                    </ul>
                </li>
                @endcan
                 */ 
                
                /*
                @can('isAdmin')
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Payroll Management</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        {{--<li class="sidebar-item"><a href="{{route('managesalary')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Manage salary details </span></a></li>--}}
                        <li class="sidebar-item"><a href="{{route('managesalary.salarylist')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Employee salary list</span></a></li>
                        {{--<li class="sidebar-item"><a href="{{route('payroll.list')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Employee salary list </span></a></li>--}}
                        {{--<li class="sidebar-item"><a href="{{route('payroll.payment')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Make payment </span></a></li>--}}
                        {{--<li class="sidebar-item"><a href="{{route('payroll.payslip')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Generate payslip </span></a></li>--}}
                    </ul>
                </li>
                @endcan

                {{--<li class="sidebar-item"><a href="{{route('event')}}" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>--}}
                <li class="sidebar-item"><a href="{{route('calendar')}}" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>


                {{--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('download')}}" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Downloads</span></a></li>--}}
                 */ 
                
                /* @can('isEmployee')
                        <li class="sidebar-item"><a href="{{route('appraisal.createfun')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Functional Appraisal</span></a></li>
                        @endcan */
                
                ?>
                
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Leaves</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @canany(['isEmployee', 'isManager']) 
                        <li class="sidebar-item"><a href="{{route('leave.create')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Apply Leave</span></a></li>
                        @endcanany
                        <li class="sidebar-item"><a href="{{route('leave')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Leave List</span></a></li>
                        {{--<li class="sidebar-item"><a href="{{route('total-leave')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Total Leave List</span></a></li>--}}
                    </ul>
                </li>
                
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Timesheets</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('timesheet.create')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Add Timesheet</span></a></li>
                        <li class="sidebar-item"><a href="{{route('timesheet')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Timesheet List</span></a></li>
                    </ul>
                </li>

               <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Goals</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @canany(['isEmployee','isManager'])
                        <li class="sidebar-item"><a href="{{route('goal')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">My Goals</span></a></li>
                        @endcanany  
                        
                        @canany(['isAdmin', 'isManager'])
                        <li class="sidebar-item"><a href="{{route('goal.userlist')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Goals List</span></a></li>
                        @endcanany
                    </ul>
               </li>


               <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Appraisals</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        

                        @canany(['isEmployee', 'isManager'])
                        <li class="sidebar-item"><a href="{{route('appraisal.create')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">My Appraisal</span></a></li>
                        @endcanany

				   @canany(['isAdmin', 'isManager'])
                        <li class="sidebar-item"><a href="{{route('appraisal')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Appraisal List</span></a></li>
                        @endcanany
                        
                       
                    </ul>
               </li>
              
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Settings</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                           <li class="sidebar-item"><a href="{{route('profile')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> My profile </span></a></li>
                           <li class="sidebar-item"><a href="{{route('profile.edit')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Edit profile </span></a></li>
                            @canany(['isAdmin'])
                            <li class="sidebar-item"><a href="{{route('attendancelog')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Attendance log </span></a></li>
                            <li class="sidebar-item"><a href="{{route('profile.addfy')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Add FY </span></a></li>
                            @endcanany
                            <li class="sidebar-item"><a href="{{route('change.password')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Change Password </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Documents</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('download.holidaylist')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Holiday List </span></a></li>
                        <li class="sidebar-item"><a href="{{route('download.companypolicy')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Company Policy </span></a></li>
                        <li class="sidebar-item"><a href="{{route('download.orggoalsdoc')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Organizational Goals </span></a></li>
                        <li class="sidebar-item"><a href="{{route('download.performance')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Performance Process</span></a></li>
                        <li class="sidebar-item"><a href="{{route('download.userguide')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> User Guide</span></a></li>
                        @canany(['isAdmin', 'isManager'])
                        <li class="sidebar-item"><a href="{{route('download.adminguide')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Admin Guide</span></a></li>
                        @endcan
                    </ul>
                </li>
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"  aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Logout</span></a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                    </form>
                </li>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>