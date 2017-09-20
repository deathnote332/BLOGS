<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipe extends Model
{
    protected  $table = 'recipies';
    protected  $primaryKey = 'id';
}
