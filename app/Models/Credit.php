<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public $casts = [
        'dueDate' => 'datetime',

    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agentId');
    }

    public function getAgentNameAttribute()
    {
        $this->load('agent');
        return $this->agent->name['en'];
    }
    public function getAgentCompanyAttribute()
    {
        $this->load('agent.agent_profile');
        return optional($this->agent->agent_profile)->company_name;
    }
}