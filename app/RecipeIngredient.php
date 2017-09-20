<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecipeIngredient extends Model
{
    protected  $table = 'recipes_ingredients';
    protected  $primaryKey = 'id';
}
