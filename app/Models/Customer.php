<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "customers";
    protected $fillable =[
        'customer_Name',
        'customer_Email',
        'catagory_List',
        'brandId_Id',
        'image',
        'pdf',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
