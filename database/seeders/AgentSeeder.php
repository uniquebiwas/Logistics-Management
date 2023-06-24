<?php

namespace Database\Seeders;

use App\Models\Agent\AgentProfile;
use App\Models\Agent\WalletBalance;
use App\Models\ServiceAgent;
use App\Models\ShipmentPackageType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' =>  [
                'np' => 'Default Agent',
                'en' => 'Default Agent'
            ],
            'email' => 'defaultagent@gmail.com',
            'phoneVerifiedAt' => date('Y-m-d'),
            'emailVerifiedAt' => date('Y-m-d'),
            'documentVerifiedAt' => date('Y-m-d'),
            'accountNumber' => 'ALG1000',
            'password' => Hash::make('agent123'),
        ]);

        AgentProfile::create([
            'userId' => $user->id,
            'address' => 'Kathmandu, kupondle',
            'vatNumber' => 12345678
        ]);

        $role = Role::create(['name' => 'Agent']);

        $user->assignRole([$role->id]);

        UserType::create([
            'userId' => $user->id,
            'typeId' => 2,
        ]);

        WalletBalance::create([
            'agentId' => $user->id,
            'balance' => 2500000,
        ]);

        ShipmentPackageType::create([
            'package_type' => 'Express Document',
            'publishStatus' => 1,
            'image' => '',
        ]);
        ShipmentPackageType::create([
            'package_type' => 'Express Parcel',
            'publishStatus' => 1,
            'image' => '',
        ]);
        ShipmentPackageType::create([
            'package_type' => 'Economy Express Parcel',
            'publishStatus' => 1,
            'image' => '',
        ]);

        ShipmentPackageType::create([
            'package_type' => 'Fright + Delivery',
            'publishStatus' => 1,
            'image' => '',
        ]);
        ShipmentPackageType::create([
            'package_type' => 'Air Fright Only',
            'publishStatus' => 1,
            'image' => '',
        ]);

        ServiceAgent::create([
            'title' => 'DHL',
            'publishStatus' => 1,
            'image' => 'https://www.dhl.com/content/dam/dhl/global/core/images/logos/dhl-logo.svg',
        ]);
        ServiceAgent::create([
            'title' => 'FedEx',
            'publishStatus' => 1,
            'image' => 'https://www.fedex.com/content/dam/fedex-com/logos/logo.png',
        ]);
    }
}
