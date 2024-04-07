<?php

namespace Imynely\Pay;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'panalties';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'amount', 'status', 'initiator_id', 'payment_id'
    ];


    function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    function payment()
    {
        return $this->hasOne(Payment::class, 'payment_id');
    }

    function initiator()
    {
        return $this->hasOne(User::class, 'initiator_id');
    }
}
