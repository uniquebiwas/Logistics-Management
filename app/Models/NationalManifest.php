<?php

namespace App\Models;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalManifest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function createManifest($data)
    {
        $this->create([
            'manifestNumber' => $this->generateManifestNumber(),
            'client' => $data['client'],
            'clientLocation' => $data['clientLocation'],
            'remarks' => $data['remarks'],
            'phone' => $data['phone'],
        ]);
    }

    protected function generateManifestNumber()
    {
        $latest = static::selectRaw('REPLACE(manifestNumber,"ALGNP-","") as manifest')
            ->where('manifestNumber', '<>', null)
            ->orderBy('id', 'desc')->first();

        if (empty($latest->manifest)) {
            return 'ALGNP-' . 1000;
        }
        return 'ALGNP-' . ((int)$latest->manifest + 1);
    }

    public function shipment()
    {
        return $this->belongsToMany(ShipmentPackage::class, 'national_manifest_packages', 'nationalManifestId', 'shipmentId')
            ->withPivot('remarks');
    }
}
