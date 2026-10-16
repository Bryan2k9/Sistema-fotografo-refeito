<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Photo;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'foto_id',
    ];

    public function user() {
        return $this->BelongsTo(User::class);
    }

    public function foto() {
        return $this->BelongsTo(Photo::class);
    }
}
