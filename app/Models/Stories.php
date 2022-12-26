<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categories;
use App\Models\Authors;
class Stories extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','alias','content','view','status','source','image','user_id','keyword','description','slug','author_id'];
    protected $table = 'stories';
    protected $primaryKey = 'id';

    public function authors() {
        return $this->belongsTo(Authors::class, 'author_id');
    }

    public function story_cate() {
        return $this->hasMany(Story_Categories::class,'story_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function users() {
        return $this->hasOne(User::class,'id','user_id');
    }
}
