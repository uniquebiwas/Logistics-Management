<?php

namespace App\Models\Agent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'agentId',
        "balance"
    ];
    public function agent()
    {
        return $this->hasOne(User::class, 'id', 'agentId');
    }

    public function getWallet()
    {
        $wallet =   $this->where('agentId', auth()->user()->id)->first();
        if (!$wallet) {
            $data = [
                'agentId' => auth()->id(),
                'balance' => 0
            ];
            $wallet = $this->create($data);
        }
        return $wallet;
    }
}
