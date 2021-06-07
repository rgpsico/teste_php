<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['title', 'description'];
    protected $table = 'products';
}
