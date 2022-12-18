<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    use HasFactory;
    protected $fillable = ['name','subname','alias','content','view','story_id'];
    protected $table = 'chapters';
    protected $primaryKey = 'id';
}
