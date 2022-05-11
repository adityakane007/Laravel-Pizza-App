<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDashboard extends Model
{
    use HasFactory;
    protected $table = 'menu';
    public $timestamps = false;
}
