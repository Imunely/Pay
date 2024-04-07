<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_gateways';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'currency_id', 'payment_system_id', 
        'system_name', 'system_commision', 'status',
    ];

    function currency()
    {
        return $this->hasOne(Currency::class, 'currency_id');
    }

    function system()
    {
        return $this->hasOne(PaymentSystem::class, 'payment_system_id');
    }
}
