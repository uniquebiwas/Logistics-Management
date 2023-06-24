<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','position','publish_status','created_by',"updated_by"];

    protected $casts  = [
        'title' => 'json',
    ];
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function teams()
    {
        return $this->hasMany(Team::class,'designation_id');
    }
}
