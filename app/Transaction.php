<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected  $table = 'transactions';
    protected  $primaryKey = 'id';
}
