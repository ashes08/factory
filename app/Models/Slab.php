<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slab extends Model
{
    use HasFactory;
    protected $fillable = ['slab_name','leaf','tobaco','price','status'];
}
