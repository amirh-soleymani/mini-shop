<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'admin_id',
        'inventory',
        'price'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id', 'id');
    }
}
