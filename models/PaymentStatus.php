<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    const WAITING = 0;
    const DISPUTE = 1;
    const DISPUTED = 2;
    const CANCELED = 3;
    const ERROR = 4;
    const PAID = 5;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];
}
