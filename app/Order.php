<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected  $table = 'orders';
    protected  $primaryKey = 'id';
}
