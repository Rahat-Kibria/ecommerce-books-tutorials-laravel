<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function sub_products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, self::class, 'parent_id', 'category_id');
    }
    public function books(): HasMany
    {
        return $this->hasMany(Product::class)->where('type', 'Book');
    }
    public function tutorials(): HasMany
    {
        return $this->hasMany(Product::class)->where('type', 'Tutorial');
    }
}
