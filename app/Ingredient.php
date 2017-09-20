<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingredient extends Model
{
    protected  $table = 'ingredients';
    protected  $primaryKey = 'id';
}
