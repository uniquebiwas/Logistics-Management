<?php
namespace App\Traits\Api;

use App\Models\User;

/**
 *
 */
trait SearchReseller
{
    protected function searchReseller($latitude, $longitude, $radius)
    {
        $query = User::selectRaw("
        users.currentAddress,users.currentLat,users.currentLng,users.id,users.name,users.mobile,( 6371000 * acos( cos( radians(?) ) *
                           cos( radians( users.currentLat ) )
                           * cos( radians( users.currentLng ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( users.currentLat ) ) )
                         ) AS distance", [$latitude, $longitude, $latitude])

            ->leftJoin('user_types', 'user_types.userId', 'users.id')
            ->where('user_types.verifiedAt', '!=', null)
            ->where('user_types.type', 'reseller');
        $query = $query
        // ->where('online_status', '=', 1)

            ->having("distance", "<", $radius)

            ->orderBy("distance", 'asc')
     
            // ->limit(20)
            ->get();

        return $query;
    }
}
