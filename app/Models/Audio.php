<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Audio extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'audio'];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
