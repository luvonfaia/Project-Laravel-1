<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\String\b;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

    public function user()  //metoda sa ne arate ca un blog post apartine unui user
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
