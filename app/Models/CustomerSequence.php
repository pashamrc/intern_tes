<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSequence extends Model
{
    protected $table = 'customer_sequences';

    protected $primaryKey = 'seq_date';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'seq_date',
        'last_number',
    ];
}