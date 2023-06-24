<?php

namespace App\Models\Cargo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationOfOriginGSP extends Model
{
    use HasFactory;
    protected $table = 'certification_of_origin_gsp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'issued_address',
        'reference_no',
        'exporter_details',
        'consignee_details',
        'transport',
        'official_use',
        'declaration_name',
        'declaration_title',
        'declaration_city',
        'item_no',
        'package_marks',
        'description_of_goods',
        'origin',
        'gross_weight',
        'invoice_data',
        'produced_country',
        'importing_country',
        'exporter_signature',
        'export_date',
        'createdBy',
        'updatedBy',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
