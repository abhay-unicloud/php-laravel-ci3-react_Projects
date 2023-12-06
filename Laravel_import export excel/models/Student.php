<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Student extends Model
{
    use  HasFactory;
    protected $table = 'student';
    protected $fillable = [
    'id','name','email','class','section','gender','address',];

    
}
