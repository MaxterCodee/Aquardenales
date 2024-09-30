<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBroker extends Model
{
    use HasFactory;

    protected $fillable = [
        'ph',
        'liters_min',
        'distance_cm',
        'date',
        'time',
        'broker_id',
    ];

    // belongs to broker
    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }
}
