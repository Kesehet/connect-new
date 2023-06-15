<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\TotalLeaveController;
use App\Http\Controllers\ManagesalaryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskCommentController;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'auth'], function (){

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    
    Route::get('appraisal', [AppraisalController::class, 'index'])->name('appraisal');
    Route::get('appraisal/create', [AppraisalController::class, 'create'])->name('appraisal.create');
    Route::post('appraisal/store', [AppraisalController::class, 'store'])->name('appraisal.store');
    Route::get('appraisal/createorone', [AppraisalController::class, 'createorone'])->name('appraisal.createorone');
    Route::get('appraisal/createortwo', [AppraisalController::class, 'createortwo'])->name('appraisal.createortwo');
    Route::get('appraisal/createorthree', [AppraisalController::class, 'createorthree'])->name('appraisal.createorthree');
    Route::get('appraisal/createorfour', [AppraisalController::class, 'createorfour'])->name('appraisal.createorfour');

    Route::get('appraisal/createfun', [AppraisalController::class, 'createfun'])->name('appraisal.createfun');
    Route::post('appraisal/storefun', [AppraisalController::class, 'storefun'])->name('appraisal.storefun');
    Route::get('appraisal/createfunone', [AppraisalController::class, 'createfunone'])->name('appraisal.createfunone');
    Route::get('appraisal/createfuntwo', [AppraisalController::class, 'createfuntwo'])->name('appraisal.createfuntwo');
    Route::get('appraisal/createfunthree', [AppraisalController::class, 'createfunthree'])->name('appraisal.createfunthree');
    Route::get('appraisal/createfunfour', [AppraisalController::class, 'createfunfour'])->name('appraisal.createfunfour');
    Route::get('appraisal/finalappsubmit', [AppraisalController::class, 'finalappsubmit'])->name('appraisal.finalappsubmit');
    Route::get('appraisal/generatepdf', [AppraisalController::class, 'generatepdf'])->name('appraisal.generatepdf');
	
	
	
    Route::get('appraisal/createpd', [AppraisalController::class, 'createpd'])->name('appraisal.createpd');   

    Route::get('user', [UserController::class, 'index'])->name('user');
	Route::get('user/create', [UserController::class, 'create'])->name('user.create');
	Route::post('user/store', [UserController::class, 'store'])->name('user.store');
	Route::get('user/view/{id}', [UserController::class, 'view'])->name('user.view');
	Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
	Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
	Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
	Route::get('user/search', [UserController::class, 'search'])->name('user.search');
	Route::get('user/exportall', [UserController::class, 'exportall'])->name('user.exportall');
	Route::post('user/changefy', [UserController::class, 'changefy'])->name('user.changefy');
	Route::get('user/assign/{id}', [UserController::class, 'assign'])->name('user.assign');
	Route::post('user/assignupdate/{id}', [UserController::class, 'assignupdate'])->name('user.assignupdate');
	
	Route::get('employee', [EmployeeController::class, 'index'])->name('employee');
	Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
	Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
	Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
	Route::post('employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
	Route::get('employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
	
	Route::get('designation', [DesignationController::class, 'index'])->name('designation');
	Route::get('designation/create', [DesignationController::class, 'create'])->name('designation.create');
	Route::post('designation/store', [DesignationController::class, 'store'])->name('designation.store');
	Route::get('designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
	Route::post('designation/update/{id}', [DesignationController::class, 'update'])->name('designation.update');
	Route::get('designation/delete/{id}', [DesignationController::class, 'delete'])->name('designation.delete');


    
	Route::get('department', [DepartmentController::class, 'index'])->name('department');
	Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
	Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');
	Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
	Route::post('department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
	Route::get('department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
	
	Route::get('designation', [DesignationController::class, 'index'])->name('designation');
	Route::get('designation/create', [DesignationController::class, 'create'])->name('designation.create');
	Route::post('designation/store', [DesignationController::class, 'store'])->name('designation.store');
	Route::get('designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
	Route::post('designation/update/{id}', [DesignationController::class, 'update'])->name('designation.update');
	Route::get('designation/delete/{id}', [DesignationController::class, 'delete'])->name('designation.delete');
	
	Route::get('salary', [SalaryController::class, 'index'])->name('salary');
	Route::get('salary/create', [SalaryController::class, 'create'])->name('salary.create');
	Route::post('salary/store', [SalaryController::class, 'store'])->name('salary.store');
	Route::get('salary/edit/{id}', [SalaryController::class, 'edit'])->name('salary.edit');
	Route::post('salary/update/{id}', [SalaryController::class, 'update'])->name('salary.update');
	Route::get('salary/delete/{id}', [SalaryController::class, 'delete'])->name('salary.delete');
	
	Route::get('city', [CityController::class, 'index'])->name('city');
	Route::get('city/create', [CityController::class, 'create'])->name('city.create');
	Route::post('city/store', [CityController::class, 'store'])->name('city.store');
	Route::get('city/edit/{id}', [CityController::class, 'edit'])->name('city.edit');
	Route::post('city/update/{id}', [CityController::class, 'update'])->name('city.update');
	Route::get('city/delete/{id}', [CityController::class, 'delete'])->name('city.delete');
	
	Route::get('goal', [GoalController::class, 'index'])->name('goal');
    //Route::get('goal/storemutiple', [ 'as'=>'goal.storemutiple',  'uses' => 'GoalController@storemutiple']);
   
    Route::get('goal/orgindex', [GoalController::class, 'orgindex'])->name('goal.orgindex');
	Route::match(['GET', 'POST'], 'goal/storemutiple', [GoalController::class, 'storemutiple'])->name('goal.storemutiple');
	
	Route::get('goal/create', [GoalController::class, 'create'])->name('goal.create');
	Route::post('goal/store', [GoalController::class, 'store'])->name('goal.store');
	Route::get('goal/edit/{id}', [GoalController::class, 'edit'])->name('goal.edit');
	Route::get('goal/view/{id}', [GoalController::class, 'view'])->name('goal.view');
	Route::post('goal/update/{id}', [GoalController::class, 'update'])->name('goal.update');
	Route::get('goal/delete/{id}', [GoalController::class, 'delete'])->name('goal.delete');
	
	Route::get('goal/createpd', [GoalController::class, 'createpd'])->name('goal.createpd');
	Route::post('goal/storepd', [GoalController::class, 'storepd'])->name('goal.storepd');
	
	Route::get('goal/userlist', [GoalController::class, 'userlist'])->name('goal.userlist');
	
	Route::get('shift', [ShiftController::class, 'index'])->name('shift');
	Route::get('shift/create', [ShiftController::class, 'create'])->name('shift.create');
	Route::post('shift/store', [ShiftController::class, 'store'])->name('shift.store');
	Route::get('shift/edit/{id}', [ShiftController::class, 'edit'])->name('shift.edit');
	Route::post('shift/update/{id}', [ShiftController::class, 'update'])->name('shift.update');
	Route::get('shift/delete/{id}', [ShiftController::class, 'delete'])->name('shift.delete');
	
	Route::get('leave', [LeaveController::class, 'index'])->name('leave');
	Route::get('leave/create', [LeaveController::class, 'create'])->name('leave.create');
	Route::post('leave/store', [LeaveController::class, 'store'])->name('leave.store');
	Route::get('leave/search', [LeaveController::class, 'search'])->name('leave.search');
	Route::get('leave/edit/{id}', [LeaveController::class, 'edit'])->name('leave.edit');
	Route::post('leave/update/{id}', [LeaveController::class, 'update'])->name('leave.update');
	Route::get('leave/delete/{id}', [LeaveController::class, 'delete'])->name('leave.delete');
	Route::post('leave/approve/{id}', [LeaveController::class, 'approve'])->name('leave.approve');
	Route::post('leave/paid/{id}', [LeaveController::class, 'paid'])->name('leave.paid');
        
    Route::get('timesheet', [TimesheetController::class, 'index'])->name('timesheet');
	Route::get('timesheet/search', [TimesheetController::class, 'search'])->name('timesheet.search');
	Route::get('timesheet/create', [TimesheetController::class, 'create'])->name('timesheet.create');
	
	Route::get('timesheet/{timesheet}/edit', [TimesheetController::class, 'edit'])->name('timesheet.edit');
	Route::put('timesheet/update/{timesheet}',[TimesheetController::class, 'update'])->name('timesheet.update');
	
	Route::post('timesheet/store', [TimesheetController::class, 'store'])->name('timesheet.store');
	Route::get('timesheet/delete/{id}', [TimesheetController::class, 'delete'])->name('timesheet.delete');
	Route::get('timesheet/ajaxindex/{id}', [TimesheetController::class, 'ajaxindex'])->name('timesheet.ajaxindex');
	Route::get('timesheet/ajaxdelete/{id}', [TimesheetController::class, 'ajaxdelete'])->name('timesheet.ajaxdelete');
	
	Route::get('total-leave', [TotalLeaveController::class, 'index'])->name('total-leave');
	Route::get('total-leave/create', [TotalLeaveController::class, 'create'])->name('total-leave.create');
	Route::post('total-leave/store', [TotalLeaveController::class, 'store'])->name('total-leave.store');
	Route::get('total-leave/edit/{id}', [TotalLeaveController::class, 'edit'])->name('total-leave.edit');
	Route::post('total-leave/update/{id}', [TotalLeaveController::class, 'update'])->name('total-leave.update');
	Route::get('total-leave/delete/{id}', [TotalLeaveController::class, 'delete'])->name('total-leave.delete');
	
	Route::get('managesalary', [ManagesalaryController::class, 'index'])->name('managesalary');
	Route::get('managesalary/detail/{id}', [ManagesalaryController::class, 'detail'])->name('managesalary.detail');
	Route::post('managesalary/store', [ManagesalaryController::class, 'store'])->name('managesalary.store');
	Route::get('managesalary/salarylist', [ManagesalaryController::class, 'salarylist'])->name('managesalary.salarylist');
	Route::get('managesalary/makepayment', [ManagesalaryController::class, 'makepayment'])->name('managesalary.makepayment');
	Route::post('managesalary/make-advance', [ManagesalaryController::class, 'makeAdvance'])->name('managesalary.makeadvance');
	
	Route::get('event', [EventController::class, 'event'])->name('event');
	Route::post('event/store', [EventController::class, 'store'])->name('event.store');
	
	Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
	Route::get('calendar/add', [CalendarController::class, 'add'])->name('calendar.add');
	Route::post('calendar/store', [CalendarController::class, 'store'])->name('calendar.store');


    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
	Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
	Route::get('profile/personal', [ProfileController::class, 'personal'])->name('profile.personal');
	Route::post('profile/updatepersonal', [ProfileController::class, 'updatepersonal'])->name('profile.updatepersonal');
	Route::get('profile/education', [ProfileController::class, 'education'])->name('profile.education');
	Route::post('profile/updateducation', [ProfileController::class, 'updateducation'])->name('profile.updateducation');
	Route::get('profile/important', [ProfileController::class, 'important'])->name('profile.important');
	Route::post('profile/updateimportant', [ProfileController::class, 'updateimportant'])->name('profile.updateimportant');
	Route::get('profile/exitdetails', [ProfileController::class, 'exitdetails'])->name('profile.exitdetails');
	Route::post('profile/updatexit', [ProfileController::class, 'updatexit'])->name('profile.updatexit');
	Route::get('change-password', [ProfileController::class, 'changePassword'])->name('change.password');
	Route::match(['post', 'match'], 'update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
	Route::get('attendancelog', [ProfileController::class, 'attendancelog'])->name('attendancelog');
	Route::get('profile/addfy', [ProfileController::class, 'addfy'])->name('profile.addfy');
	Route::post('profile/updatefy', [ProfileController::class, 'updatefy'])->name('profile.updatefy');
	
	Route::get('downloads', [DownloadController::class, 'index'])->name('download');
	Route::get('downloads/holidaylist', [DownloadController::class, 'holidaylist'])->name('download.holidaylist');
	Route::get('downloads/companypolicy', [DownloadController::class, 'companypolicy'])->name('download.companypolicy');
	Route::get('downloads/orggoalsdoc', [DownloadController::class, 'orggoalsdoc'])->name('download.orggoalsdoc');
	Route::get('downloads/performance', [DownloadController::class, 'performance'])->name('download.performance');
	Route::get('downloads/userguide', [DownloadController::class, 'userguide'])->name('download.userguide');
	Route::get('downloads/adminguide', [DownloadController::class, 'adminguide'])->name('download.adminguide');
    

	Route::resource('tasks', 'TaskController');
	Route::get("tasks",[TaskController::class,"index"])->name("tasks.index");
	Route::get("tasks/edit/{task}",[TaskController::class,"edit"])->name("tasks.edit");
	Route::delete("tasks/destroy/{task}",[TaskController::class,"destroy"])->name("tasks.destroy");
	Route::post("tasks/update/{task}",[TaskController::class,"update"])->name("tasks.update");
	Route::get("tasks/create",[TaskController::class,"create"])->name("tasks.create");
	Route::post("tasks/store",[TaskController::class,"store"])->name("tasks.store");
	Route::post("/tasks/archive/{task}/{archive}",[TaskController::class,"archiveTask"])->name("tasks.archive");
	
	Route::post('tasks/{task}/subtasks', [TaskController::class, 'createSubtask'])->name('tasks.subtasks.create');
	Route::put('subtasks/{subtask}', [TaskController::class, 'updateSubtask'])->name('tasks.subtasks.update');
	Route::delete('tasks/{task}/subtasks/{subtask}', [TaskController::class, 'deleteSubtask'])->name('tasks.subtasks.delete');
	
	Route::post('/subtasks/{subtask}/status', [TaskController::class, 'updateSubtaskStatus'])->name('subtasks.updateStatus');
	Route::get('/subtasks/{subtask}/editSubtask', [TaskController::class, 'editSubtask'])->name('subtasks.editSubtask');
	

	// Route for storing a new task comment
	Route::post('/task-comments', [TaskCommentController::class, 'store'])->name('task-comments.store');
	// Route for updating an existing task comment
	Route::put('/task-comments/{taskComment}', [TaskCommentController::class, 'update'])->name('task-comments.update');
	// Route for deleting a task comment
	Route::post('/task-comments/{taskComment}', [TaskCommentController::class, 'destroy'])->name('task-comments.destroy');


});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');




