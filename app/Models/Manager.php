<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    use HasFactory;
    protected $table = 'manager';
    protected $primaryKey = 'user_id';
}
