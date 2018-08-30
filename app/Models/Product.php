<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'category_id', 'slug', 'price', 'amount', 'active'];

    public static function rules()
    {
      return [
          'category_id'   => 'required',
          'title'         => 'required',
          'slug'          => 'required',
          'price'         => 'required',
          'amount'        => 'required'
      ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
