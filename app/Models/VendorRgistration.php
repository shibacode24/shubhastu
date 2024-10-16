<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorRgistration extends Model
{
    use HasFactory;
    protected $table="vendor_rgistrations";
    protected $fillable=[
        'vendor_name',
        'contact_no',
        'email_id',
        'address'
    ];
}
