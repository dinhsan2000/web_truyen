<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story_Categories extends Model
{
    use HasFactory;
    protected $fillable = ['story_id','category_id'];
    protected $table = 'story_categories';
    //protected $primaryKey = 'id';

    public function stories()
    {
        return $this->hasMany(Stories::class, 'story_id');
    }
}
