<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargRequest extends Model
{
    use HasFactory;

    protected $table = 'recharge_request';

    protected $fillable = [
        'id',
        'merchant_id',
        'amount',
        'status',
        'proof_image',
        'payment_note',
        'slip_number',
        'payment_date',
    ];

    public function rechargeRequest(){
        return $this->belongsTo(Admin::class, 'merchant_id');
    }
}
