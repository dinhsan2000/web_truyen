<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['name','alias','parent_id','keyword','description','slug','status'];
    protected $table = 'categories';
    //protected $primaryKey = 'id';

    public function story_cate()
    {
        return $this->hasMany(Categories::class);
    }
}
