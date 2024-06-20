<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =
        [
<<<<<<< HEAD
            'user_id', 'title', 'content', 'image'
=======
            'user_id', 'title', 'content','image'
>>>>>>> origin/master
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
=======
>>>>>>> origin/master
}
