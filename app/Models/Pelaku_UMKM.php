<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaku_UMKM extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    use HasFactory;
    protected $table = 'pelaku_umkm';
    protected $primaryKey = 'user_id';
}
