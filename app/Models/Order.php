<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'status',
        'recipe_id',
        'client_id'
    ];
    public function Recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
}
