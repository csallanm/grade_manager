<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;
    protected $table = "semester";
    protected $guarded = [];
}