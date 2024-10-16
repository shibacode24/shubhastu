<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeRegister extends Model
{
    use HasFactory;
    protected $table="employe_registers";
    protected $fillable=[
        'employee_name',
        'contact_no',
        'email_id',
        'address'
    ];
}
