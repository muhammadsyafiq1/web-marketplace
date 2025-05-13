<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','description','category_id','user_id','sold_out','price','stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
        // JIKA INGIN HASONE 'ID','USERS_ID'
    }

    public function productvariant()
    {
        return $this->belongsTo(ProductVariant::class ,'id' ,'product_id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }

    public function comentar()
    {
        return $this->hasMany(Comentar::class, 'product_id');
    }
}
