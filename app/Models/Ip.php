<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ips';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'desc',
    ];
}
