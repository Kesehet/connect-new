<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return User::all();
        $selectArr = array(
            'users.id',
            'users.emp_id',
            'users.username',
            'users.first_name',
            'users.last_name',
            'users.role',
            'users.email',
            'users.phone',
            'users.address',
            'users.gender',
            'users.dob',
            'users.join_date',
            'users.relieve_date',
            'users.job_type',
            'users.city',
            'users.age',
            'users.designation',
            'users.manager',
            'users.department',
            'users.tenure',
            'users.last_working',
            'users.father_name',
            'users.blood_group',
            'users.spous_name',
            'users.mrtl_status',
            'users.email_personal',
            'users.emr_contact_name',
            'users.emr_contact_no',
            'users.exp_bfjoin',
            'users.pre_org',
            'users.current_address',
            'users.skills',
            'userdetails.certification',
            'userdetails.grd_diploma',
            'userdetails.uni_grd',
            'userdetails.inst_grd',
            'userdetails.year_pass_grd',
            'userdetails.uni_pg',
            'userdetails.inst_pg',
            'userdetails.year_pass_pg',
            'users.created_at',
        );
                
        return User::leftJoin('userdetails', 'userdetails.user_id', '=', 'users.id')->select($selectArr)->where('users.id', '>' ,0)->get();
        
    }
    
    public function headings() : array{
        return [
            'id',
            'emp_id',
            'username',
            'first_name',
            'last_name',
            'role',
            'email',
            'phone',
            'address',
            'gender',
            'dob',
            'join_date',
            'relieve_date',
            'job_type',
            'city',
            'age',
            'designation',
            'manager',
            'department',
            'tenure',
            'last_working',
            'father_name',
            'blood_group',
            'spous_name',
            'mrtl_status',
            'email_personal',
            'emr_contact_name',
            'emr_contact_no',
            'exp_bfjoin',
            'pre_org',
            'current_address',
            'skills',
            'certification',
            'grd_diploma',
            'uni_grd',
            'inst_grd',
            'year_pass_grd',
            'uni_pg',
            'inst_pg',
            'year_pass_pg',
            'created_at',
        ];
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },

        ];
    } 
    
    
    
}
