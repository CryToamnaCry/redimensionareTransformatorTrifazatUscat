<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function likedBy(User $user)
    {
        return $this -> likes -> contains('user_id',$user->id); // => True/Fals
        // contains() <-laravel collection method that allows us to look inside the collection
    }

    protected $fillable = [
        'body'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
