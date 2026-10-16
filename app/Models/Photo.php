<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Photo extends Model
{

    protected $table = 'fotos';

    protected $fillable = [
        'title',
        'user_id',
        'photo',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function like(): HasMany {
        return $this->hasMany(Like::class, 'foto_id');
    }
}
