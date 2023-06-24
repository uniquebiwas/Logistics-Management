<?php

namespace Database\Seeders;

use App\Models\TypeOfUser;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        $user_types = [
            [
                'id' => 1,
                "title" => "Admin",
                "publishStatus" => true,
            ],
            [
                'id' => 2,
                "title" => "Agent",
                "publishStatus" => true,
            ],
            [
                'id' => 3,
                "title" => "Customer",
                "publishStatus" => true,
            ],
        ];
        foreach ($user_types as $typesItem) {
            $menu = new TypeOfUser();
            if ($menu->where('id', $typesItem['id'])->count() > 0) {
                $menu = $menu->where('id', $typesItem['id'])->first();
            }
            $menu->fill($typesItem);
            $menu->save();
        }
    }
}
