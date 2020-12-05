<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $table = 'product_translations';

    protected $fillable = ['product_id', 'locale', 'name', 'desc'];

    public $timestamps = false;
}
