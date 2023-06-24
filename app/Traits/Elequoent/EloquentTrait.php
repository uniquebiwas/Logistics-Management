<?php

namespace App\Traits\Elequoent;

use App\Models\Admin;

trait EloquentTrait
{
    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'addedBy');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updatedBy');
    }
}
