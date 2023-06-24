<?php

namespace App\Models\Agent;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'walletId',
        'agentId',
        'approved_amount',
        'amount',
        'image',
        'paymentMethod',
        'paymentGateway',
        'transactionId',
        'type',
        'status',
        'remarks',
        'verifiedBy',
    ];

    public function wallet(){
        return $this->hasOne(WalletBalance::class, "id", 'walletId');
    }
    public function agent(){
        return $this->hasOne(User::class, 'id', 'agentId');
    }
    public function get_agent(){
        return $this->hasOne(User::class, 'id', 'agentId');
    }

    public function verifier(){
        return $this->hasOne(User::class, 'id', 'verifiedBy');
    }
}
