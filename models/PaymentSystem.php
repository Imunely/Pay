<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSystem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_systems';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'project_id',
        'client_id', 'client_secret', 'api_url',
        'callback_url', 'additional'
    ];


    function currency()
    {
        return $this->hasOne(Currency::class, 'currency_id');
    }


    function project()
    {
        return $this->hasOne(Project::class, 'project_id');
    }
}
