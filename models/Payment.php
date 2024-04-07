<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'gateway_id', 'penalty_id',
        'external_id', 'amount', 'real_amount',
        'paid_amount', 'status_id', 'wallet', 'url'
    ];

    public function status()
    {
        return $this->hasOne(PaymentStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }


    public function gateway()
    {
        return $this->hasOne(PaymentGateway::class, 'gateway_id');
    }

    public function penalty()
    {
        return $this->hasOne(Penalty::class, 'penalty_id');
    }

    public function currency()
    {
        return $this->hasOneThrough(Currency::class, PaymentGateway::class, 'currency_id', 'id');
    }
}
