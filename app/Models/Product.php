<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = ['category_id', 'image', 'purchase_price', 'sale_price', 'stock'];

    protected $with = ['translations'];

    protected $translatedAttributes = ['name', 'desc'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute($value)
    {
        return 'images/Products/'.$value;
    }

    public function getProfitPercentAttribute($value)
    {
        $profit = $this->sale_price - $this->purchase_price ;
        $profit_percent = ($profit / $this->purchase_price) * 100 ;
        return number_format($profit_percent, 2) . " %";
    }

}
