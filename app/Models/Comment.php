<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [ 'content', 'article_id', 'user_id'];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}
