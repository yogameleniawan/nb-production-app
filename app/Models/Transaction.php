<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    public $timestamps = true;

    protected $fillable = [
        'id',
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
