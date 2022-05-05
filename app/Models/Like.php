<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_liked_id',
        'playlist_id',
    ];

    public function userLiked()
    {
        return $this->belongsTo(User::class);
    }
}
