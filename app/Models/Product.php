<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'price',
        'sku',
    ];
}
