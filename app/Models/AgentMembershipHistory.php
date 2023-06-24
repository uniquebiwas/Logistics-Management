<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentMembershipHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'agentId',
        'isExpired',
        'membershipPackageId',
        'totalAmount',
        'totalRequest',
        'usedRequest',
        'cancelledRequest',
        'remainingRequestCount',
    ];
    protected $casts = [
        "deleted_at" => "date"
    ];
    public function get_package()
    {
        return $this->hasOne('App\Models\Admin\MembershipPackage', 'id', 'membershipPackageId');
    }
    public function get_agent()
    {
        return $this->hasOne('App\Models\User', 'id', 'agentId');
    }
}
