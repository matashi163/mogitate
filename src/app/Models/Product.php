<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    public function season()
    {
        return $this->belongsToMany(Season::class, 'product_seasons');
    }

    public function scopeSearch($query, $search)
    {
        if(!empty($search)){
            $query->where('name', 'like', '%' . $search . '%');
        }
    }
}
