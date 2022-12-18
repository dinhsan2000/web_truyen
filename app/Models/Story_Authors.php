<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story_Authors extends Model
{
    use HasFactory;
    protected $fillable = ['story_id','author_id'];
    protected $table = 'story_authors';
    protected $primaryKey = 'id';
}
