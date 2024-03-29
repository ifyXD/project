<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    protected $fillable = [
        'content', 'qty', 'unitcost', 'totalcost', 'laborneeded'
    ];
}