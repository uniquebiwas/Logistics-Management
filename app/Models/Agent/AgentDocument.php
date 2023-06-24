<?php

namespace App\Models\Agent;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agentId',
        "comments",
        'documentType',
        'verifiedAt',
        'verifiedBy',
        'documentNo',
        'documentPath',
        'status',
    ];
    protected $dates = ['deleted_at'];
    public function agent()
    {
        return $this->hasOne(User::class, 'id', 'agentId');
    }
    public function verifier()
    {
        return $this->hasOne(User::class, 'id', 'verifiedBy');
    }
}
