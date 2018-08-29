<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'category_id', 'slug', 'price', 'amount', 'active'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
