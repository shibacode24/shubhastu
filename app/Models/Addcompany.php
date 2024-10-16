<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addcompany extends Model
{
    use HasFactory;
    protected $table="addcompanies";
    protected $fillable=['Name','Address','Contact_Person','Mobile'];
}
