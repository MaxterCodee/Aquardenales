<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serial',
        'habitants',
        'depth_cm',
        'liter_capacity',
        'user_id',
    ];

    // belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function data_brokers()
    {
        return $this->hasMany(DataBroker::class);
    }
}
