<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class House extends Model
{
    use HasFactory;
    use Searchable, SoftDeletes;
    protected $fillable = [
        'street',
        'ward',
        'district',
        'city', 
        'area', 
        'price', 
        'description', 
        'type', 
        'bedrooms', 
        'bathrooms', 
        'image'
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();
    
        // Ensure deleted_at is indexed
        $array['deleted_at'] = $this->deleted_at ? $this->deleted_at->toISOString() : null;

        return $array;
    }

    public function abac()
    {
        House::create([
             'street' => 'La Thanh',
             'ward' => 'La Thanh',
             'district' => 'Ba Dinh',
             'city' => 'Ha Noi',
             'area' => 66.0,
             'price' => 216540.00,
             'description' => 'This is a beautiful house',
             'type' => 'House',
             'bedrooms' => 5,
             'bathrooms' => 5,
             'image' => 'img.jpg'
        ]);
    }
}
