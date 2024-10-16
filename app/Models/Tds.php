<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tds extends Model
{
    use HasFactory;
    protected $table="tds";
    protected $fillable=['tds','date'];

    // protected $casts=[
    //     'tds'=>'array',
    //     'date'=>'array',
    // ];
}
