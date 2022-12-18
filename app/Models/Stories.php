<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    use HasFactory;
    protected $fillable = ['name','alias','content','view','status','source','image','user_id','keyword','description','slug'];
    protected $table = 'stories';
    protected $primaryKey = 'id';

    public function authors() {
        return $this->belongsToMany(Authors::class, 'story_authors', 'id','story_id');
    }

    public function categories() {
        return $this->belongsToMany(Categories::class,'story_categories','id','story_id');
    }

    public function users() {
        return $this->hasMany(User::class,'id','user_id');
    }
}
