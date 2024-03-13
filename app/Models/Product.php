<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    // protected $fillable = ['id', 'category_id', 'name', 'author', 'slug', 'short_description', 'description', 'type', 'price', 'image', 'video', 'discount', 'quantity', 'stock_status', 'featured'];
    // protected $cast = ['image' => 'array', 'video' => 'array'];
    protected $guarded = [];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
