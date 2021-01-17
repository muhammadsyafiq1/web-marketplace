<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'shipping_price', 'insurance_price'
        ,'total_price','transaction_status','transaction_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactiondetail()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
