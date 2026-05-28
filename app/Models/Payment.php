<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id', 'transaction_id', 'amount', 'status'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
