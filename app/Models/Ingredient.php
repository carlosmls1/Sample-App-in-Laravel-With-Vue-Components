<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //
    protected $fillable = [
        'name',
        'qty',
        'description',
    ];
    /**
     * The Recipe that belong to the Ingredient.
     */
    public function Recipie()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredient');
    }
}
