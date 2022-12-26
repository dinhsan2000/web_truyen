<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stories;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','alias','parent_id','keyword','description','slug','status'];
    protected $table = 'categories';
    protected $primaryKey = 'id';
}
