<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'order_evaluations';

    protected $fillable = [
        'order_id',
        'client_id',
        'stars',
        'comment',
    ];

    /**
     * Get order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


}
