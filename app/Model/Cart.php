<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $fillable = ['user_id', 'product_id', 'quantity', 'item_price', 'status'];



}
