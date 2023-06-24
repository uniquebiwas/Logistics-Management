<?php

namespace App\Models\Cargo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationOfOriginNCC extends Model
{
    use HasFactory;
    protected $table  = 'certification_of_origin_ncc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_no',
        'exporter_details',
        'exporter_registration_no',
        'firm_registration_no',
        'place_and_data',
        'consignee_details',
        'transport',
        'license_no',
        'declaration_name',
        'declaration_title',
        'declaration_city',
        'package_marks',
        'description_of_goods',
        'value',
        'quantity',
        'production',
        'invoice_data',
        'export_date',
        'value_in_words',
        'createdBy',
        'updatedBy'
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
