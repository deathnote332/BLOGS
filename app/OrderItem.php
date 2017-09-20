<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    protected  $table = 'order_items';
    protected  $primaryKey = 'id';
}
