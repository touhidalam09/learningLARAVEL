<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'catagorys';
    protected $fillable =[
        'catagoryName'
    ];
    public $timestamps = false;
}
