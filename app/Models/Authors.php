<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    protected $fillable = ['name','alias','keyword','description','author','slug','status'];
    protected $table = 'authors';
    protected $primaryKey = 'id';
}
