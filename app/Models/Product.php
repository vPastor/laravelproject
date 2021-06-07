<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeCategory($query,$input){
        return $query->where('category','=',$input);
    }
    public function scopeRating($query,$input){
        return $query->whereIn('rating',$input);
    }
    public function scopeQuantity($query, $quantity, $id) {
        return $query->where('id', '=', $id)->where('quantity', '>=', $quantity);
    }
}
