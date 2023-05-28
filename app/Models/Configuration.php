<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'model',
        'seeds',
        'field_type'
    ];

    public function title(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => str_replace('_', ' ', $attributes['name']));
    }

    public function data(): Attribute
    {
        return Attribute::make(get: function ($value, $attributes) {
            if (!is_null($attributes['model']))
            {
                return $attributes['model']::all();
            }
            if (!is_null($attributes['seeds']))
            {
                $seeds = explode(',', $attributes['seeds']);
                $data = [];
                foreach ($seeds as $seed)
                {
                    $data[] = ['id' => $seed, 'name' => $seed];
                }
                return  $data;
            }
            return [];
        });
    }
    
}
