<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
