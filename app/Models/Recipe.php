<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
    ];
    /**
     * The Ingredients that belong to the Recipe.
     */
    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient')->withPivot('qty');
    }
}
