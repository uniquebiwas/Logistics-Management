<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            ['id' => 1, 'name' => 'user-list', 'group_name' => 'users'],
            ['id' => 2, 'name' => 'user-create', 'group_name' => 'users'],
            ['id' => 3, 'name' => 'user-edit', 'group_name' => 'users'],
            ['id' => 4, 'name' => 'user-delete', 'group_name' => 'users'],

            ['id' => 5, 'name' => 'menu-list', 'group_name' => 'menu'],
            ['id' => 6, 'name' => 'menu-create', 'group_name' => 'menu'],
            ['id' => 7, 'name' => 'menu-edit', 'group_name' => 'menu'],
            ['id' => 8, 'name' => 'menu-delete', 'group_name' => 'menu'],

            ['id' => 9, 'name' => 'slider-list', 'group_name' => 'slider'],
            ['id' => 10, 'name' => 'slider-create', 'group_name' => 'slider'],
            ['id' => 11, 'name' => 'slider-edit', 'group_name' => 'slider'],
            ['id' => 12, 'name' => 'slider-delete', 'group_name' => 'slider'],

            ['id' => 13, 'name' => 'information-list', 'group_name' => 'information'],
            ['id' => 14, 'name' => 'information-create', 'group_name' => 'information'],
            ['id' => 15, 'name' => 'information-edit', 'group_name' => 'information'],
            ['id' => 16, 'name' => 'information-delete', 'group_name' => 'information'],

            ['id' => 17, 'name' => 'feature-list', 'group_name' => 'feature'],
            ['id' => 18, 'name' => 'feature-create', 'group_name' => 'feature'],
            ['id' => 19, 'name' => 'feature-edit', 'group_name' => 'feature'],
            ['id' => 20, 'name' => 'feature-delete', 'group_name' => 'feature'],

            ['id' => 21, 'name' => 'testimonial-list', 'group_name' => 'testimonial'],
            ['id' => 22, 'name' => 'testimonial-create', 'group_name' => 'testimonial'],
            ['id' => 23, 'name' => 'testimonial-edit', 'group_name' => 'testimonial'],
            ['id' => 24, 'name' => 'testimonial-delete', 'group_name' => 'testimonial'],

            // ['id' => 25, 'name' => 'faq-list','group_name' => 'faq'],
            // ['id' => 26, 'name' => 'faq-create','group_name' => 'faq'],
            // ['id' => 27, 'name' => 'faq-edit','group_name' => 'faq'],
            // ['id' => 28, 'name' => 'faq-delete','group_name' => 'faq'],

            // ['id' => 29, 'name' => 'tag-list','group_name' => 'tag'],
            // ['id' => 30, 'name' => 'tag-create','group_name' => 'tag'],
            // ['id' => 31, 'name' => 'tag-edit','group_name' => 'tag'],
            // ['id' => 32, 'name' => 'tag-delete','group_name' => 'tag'],

            ['id' => 33, 'name' => 'blog-list', 'group_name' => 'blog'],
            ['id' => 34, 'name' => 'blog-create', 'group_name' => 'blog'],
            ['id' => 35, 'name' => 'blog-edit', 'group_name' => 'blog'],
            ['id' => 36, 'name' => 'blog-delete', 'group_name' => 'blog'],

            ['id' => 37, 'name' => 'contact-list', 'group_name' => 'contact'],
            ['id' => 38, 'name' => 'contact-view', 'group_name' => 'contact'],
            ['id' => 39, 'name' => 'contact-edit', 'group_name' => 'contact'],
            ['id' => 40, 'name' => 'contact-delete', 'group_name' => 'contact'],

            ['id' => 41, 'name' => 'profile-list', 'group_name' => 'profile'],
            ['id' => 42, 'name' => 'profile-create', 'group_name' => 'profile'],
            ['id' => 43, 'name' => 'profile-edit', 'group_name' => 'profile'],
            ['id' => 44, 'name' => 'profile-delete', 'group_name' => 'profile'],

            // ['id' => 45, 'name' => 'advertisementposition-list','group_name' => 'menu'],
            // ['id' => 46, 'name' => 'advertisementposition-create','group_name' => 'menu'],
            // ['id' => 47, 'name' => 'advertisementposition-edit','group_name' => 'menu'],
            // ['id' => 48, 'name' => 'advertisementposition-delete','group_name' => 'menu'],

            // ['id' => 49, 'name' => 'advertisement-list','group_name' => 'menu'],
            // ['id' => 50, 'name' => 'advertisement-create','group_name' => 'menu'],
            // ['id' => 51, 'name' => 'advertisement-edit','group_name' => 'menu'],
            // ['id' => 52, 'name' => 'advertisement-delete','group_name' => 'menu'],


            // ['id' => 61, 'name' => 'env-list','group_name' => 'menu'],
            // ['id' => 62, 'name' => 'env-create','group_name' => 'menu'],
            // ['id' => 63, 'name' => 'env-edit','group_name' => 'menu'],
            // ['id' => 64, 'name' => 'env-delete','group_name' => 'menu'],

            ['id' => 65, 'name' => 'news-list', 'group_name' => 'news'],
            ['id' => 66, 'name' => 'news-create', 'group_name' => 'news'],
            ['id' => 67, 'name' => 'news-edit', 'group_name' => 'news'],
            ['id' => 68, 'name' => 'news-delete', 'group_name' => 'news'],


            // ['id' => 73, 'name' => 'guest-list','group_name' => 'menu'],
            // ['id' => 74, 'name' => 'guest-create','group_name' => 'menu'],
            // ['id' => 75, 'name' => 'guest-edit','group_name' => 'menu'],
            // ['id' => 76, 'name' => 'guest-delete','group_name' => 'menu'],

            // ['id' => 77, 'name' => 'blogCategory-list','group_name' => 'menu'],
            // ['id' => 78, 'name' => 'blogCategory-create','group_name' => 'menu'],
            // ['id' => 79, 'name' => 'blogCategory-edit','group_name' => 'menu'],
            // ['id' => 80, 'name' => 'blogCategory-delete','group_name' => 'menu'],

            ['id' => 81, 'name' => 'designation-list', 'group_name' => 'Team Designation'],
            ['id' => 82, 'name' => 'designation-create', 'group_name' => 'Team Designation'],
            ['id' => 83, 'name' => 'designation-edit', 'group_name' => 'Team Designation'],
            ['id' => 84, 'name' => 'designation-delete', 'group_name' => 'Team Designation'],

            ['id' => 85, 'name' => 'team-list', 'group_name' => 'team'],
            ['id' => 86, 'name' => 'team-create', 'group_name' => 'team'],
            ['id' => 87, 'name' => 'team-edit', 'group_name' => 'team'],
            ['id' => 88, 'name' => 'team-delete', 'group_name' => 'team'],





            // ['id' => 98, 'name' => 'subscriber-list','group_name' => 'menu'],
            // ['id' => 99, 'name' => 'subscriber-create','group_name' => 'menu'],
            // ['id' => 99, 'name' => 'subscriber-edit','group_name' => 'menu'],
            // ['id' => 100, 'name' => 'subscriber-delete','group_name' => 'menu'],

            ['id' => 101, 'name' => 'roles-list', 'group_name' => 'roles'],
            ['id' => 102, 'name' => 'roles-create', 'group_name' => 'roles'],
            ['id' => 103, 'name' => 'roles-edit', 'group_name' => 'roles'],
            ['id' => 104, 'name' => 'roles-delete', 'group_name' => 'roles'],

            // ['id' => 105, 'name' => 'mediaLibrary-list','group_name' => 'menu'],
            // ['id' => 106, 'name' => 'advertisement-sort','group_name' => 'menu'],
            // ['id' => 107, 'name' => 'advertisement-publish','group_name' => 'menu'],


            // ['id' => 112, 'name' => 'video-list','group_name' => 'menu'],
            // ['id' => 113, 'name' => 'video-create','group_name' => 'menu'],
            // ['id' => 114, 'name' => 'video-edit','group_name' => 'menu'],
            // ['id' => 115, 'name' => 'video-delete','group_name' => 'menu'],

            // ['id' => 116, 'name' => 'serviceCategory-list','group_name' => 'menu'],
            // ['id' => 117, 'name' => 'serviceCategory-create','group_name' => 'menu'],
            // ['id' => 118, 'name' => 'serviceCategory-edit','group_name' => 'menu'],
            // ['id' => 119, 'name' => 'serviceCategory-delete','group_name' => 'menu'],

            // ['id' => 120, 'name' => 'promotion-list','group_name' => 'menu'],
            // ['id' => 121, 'name' => 'promotion-create','group_name' => 'menu'],
            // ['id' => 122, 'name' => 'promotion-edit','group_name' => 'menu'],
            // ['id' => 123, 'name' => 'promotion-delete','group_name' => 'menu'],

            // ['id' => 124, 'name' => 'membershipType-list','group_name' => 'menu'],
            // ['id' => 125, 'name' => 'membershipType-create','group_name' => 'menu'],
            // ['id' => 126, 'name' => 'membershipType-edit','group_name' => 'menu'],
            // ['id' => 127, 'name' => 'membershipType-delete','group_name' => 'menu'],

            // ['id' => 128, 'name' => 'wallet-list','group_name' => 'menu'],
            // ['id' => 129, 'name' => 'wallet-create','group_name' => 'menu'],
            // ['id' => 130, 'name' => 'wallet-edit','group_name' => 'menu'],
            // ['id' => 131, 'name' => 'wallet-delete','group_name' => 'menu'],

            ['id' => 132, 'name' => 'agent-list', 'group_name' => 'agent'],
            ['id' => 133, 'name' => 'agent-create', 'group_name' => 'agent'],
            ['id' => 134, 'name' => 'agent-edit', 'group_name' => 'agent'],
            ['id' => 135, 'name' => 'agent-delete', 'group_name' => 'agent'],

            // ['id' => 136, 'name' => 'servicerequest-list','group_name' => 'menu'],
            // ['id' => 137, 'name' => 'servicerequest-create','group_name' => 'menu'],
            // ['id' => 138, 'name' => 'servicerequest-edit','group_name' => 'menu'],
            // ['id' => 139, 'name' => 'servicerequest-delete','group_name' => 'menu'],

            // ['id' => 138, 'name' => 'adminnotification-list','group_name' => 'menu'],
            // ['id' => 139, 'name' => 'adminnotification-create','group_name' => 'menu'],
            // ['id' => 140, 'name' => 'adminnotification-edit','group_name' => 'menu'],
            // ['id' => 141, 'name' => 'adminnotification-delete','group_name' => 'menu'],

            ['id' => 142, 'name' => 'agentservice-list', 'group_name' => 'agentservice'],
            ['id' => 143, 'name' => 'agentservice-create', 'group_name' => 'agentservice'],
            ['id' => 144, 'name' => 'agentservice-edit', 'group_name' => 'agentservice'],
            ['id' => 145, 'name' => 'agentservice-delete', 'group_name' => 'agentservice'],

            // ['id' => 146, 'name' => 'membership-list','group_name' => 'menu'],
            // ['id' => 147, 'name' => 'membership-create','group_name' => 'menu'],
            // ['id' => 148, 'name' => 'membership-edit','group_name' => 'menu'],
            // ['id' => 149, 'name' => 'membership-delete','group_name' => 'menu'],

            ['id' => 150, 'name' => 'zonal-list', 'group_name' => 'zone'],
            ['id' => 151, 'name' => 'zonal-create', 'group_name' => 'zone'],
            ['id' => 152, 'name' => 'zonal-edit', 'group_name' => 'zone'],
            ['id' => 153, 'name' => 'zonal-delete', 'group_name' => 'zone'],

            // ['id' => 154, 'name' => 'customer-list','group_name' => 'menu'],
            // ['id' => 155, 'name' => 'customer-create','group_name' => 'menu'],
            // ['id' => 156, 'name' => 'customer-edit','group_name' => 'menu'],
            // ['id' => 157, 'name' => 'customer-delete','group_name' => 'menu'],




            ['id' => 162, 'name' => 'agent-staff-list', 'group_name' => 'agent-staff'],
            ['id' => 163, 'name' => 'agent-staff-create', 'group_name' => 'agent-staff'],
            ['id' => 164, 'name' => 'agent-staff-edit', 'group_name' => 'agent-staff'],
            ['id' => 165, 'name' => 'agent-staff-delete', 'group_name' => 'agent-staff'],
            ['id' => 166, 'name' => 'agent-staff-show', 'group_name' => 'agent-staff'],

            ['id' => 167, 'name' => 'national-manifest-list', 'group_name' => 'national-manifest'],
            ['id' => 168, 'name' => 'national-manifest-create', 'group_name' => 'national-manifest'],
            ['id' => 169, 'name' => 'national-manifest-edit', 'group_name' => 'national-manifest'],
            ['id' => 170, 'name' => 'national-manifest-delete', 'group_name' => 'national-manifest'],
            ['id' => 171, 'name' => 'national-manifest-show', 'group_name' => 'national-manifest'],

            ['id' => 172, 'name' => 'shipment-approve', 'group_name' => 'shipment'],
            ['id' => 173, 'name' => 'shipment-delete', 'group_name' => 'shipment'],
            ['id' => 174, 'name' => 'shipment-edit', 'group_name' => 'shipment'],


            ['id' => 175, 'name' => 'gallery-list', 'group_name' => 'gallery'],
            ['id' => 176, 'name' => 'gallery-create', 'group_name' => 'gallery'],
            ['id' => 177, 'name' => 'gallery-edit', 'group_name' => 'gallery'],
            ['id' => 178, 'name' => 'gallery-delete', 'group_name' => 'gallery'],
            ['id' => 179, 'name' => 'gallery-show', 'group_name' => 'gallery'],

            ['id' => 180, 'name' => 'benefit-list', 'group_name' => 'benefit'],
            ['id' => 181, 'name' => 'benefit-create', 'group_name' => 'benefit'],
            ['id' => 182, 'name' => 'benefit-edit', 'group_name' => 'benefit'],
            ['id' => 183, 'name' => 'benefit-delete', 'group_name' => 'benefit'],
            ['id' => 184, 'name' => 'benefit-show', 'group_name' => 'benefit'],



            ['id' => 186, 'name' => 'serviceagent-list', 'group_name' => 'serviceagent'],
            ['id' => 187, 'name' => 'serviceagent-create', 'group_name' => 'serviceagent'],
            ['id' => 188, 'name' => 'serviceagent-edit', 'group_name' => 'serviceagent'],
            ['id' => 189, 'name' => 'serviceagent-delete', 'group_name' => 'serviceagent'],
            ['id' => 190, 'name' => 'serviceagent-show', 'group_name' => 'serviceagent'],

            ['id' => 191, 'name' => 'shipmentpackagetype-list', 'group_name' => 'shipmentpackagetype'],
            ['id' => 192, 'name' => 'shipmentpackagetype-create', 'group_name' => 'shipmentpackagetype'],
            ['id' => 193, 'name' => 'shipmentpackagetype-edit', 'group_name' => 'shipmentpackagetype'],
            ['id' => 194, 'name' => 'shipmentpackagetype-delete', 'group_name' => 'shipmentpackagetype'],
            ['id' => 195, 'name' => 'shipmentpackagetype-show', 'group_name' => 'shipmentpackagetype'],

            ['id' => 196, 'name' => 'create-awb-as-default-admin', 'group_name' => 'shipment'],

            ['id' => 197, 'name' => 'location-list', 'group_name' => 'location'],
            ['id' => 198, 'name' => 'location-create', 'group_name' => 'location'],
            ['id' => 199, 'name' => 'location-edit', 'group_name' => 'location'],
            ['id' => 200, 'name' => 'location-delete', 'group_name' => 'location'],
            ['id' => 201, 'name' => 'location-show', 'group_name' => 'location'],

            ['id' => 202, 'name' => 'agentcredit-list', 'group_name' => 'agentcredit'],
            ['id' => 203, 'name' => 'agentcredit-create', 'group_name' => 'agentcredit'],
            ['id' => 204, 'name' => 'agentcredit-edit', 'group_name' => 'agentcredit'],
            ['id' => 205, 'name' => 'agentcredit-delete', 'group_name' => 'agentcredit'],
            ['id' => 206, 'name' => 'agentcredit-show', 'group_name' => 'agentcredit'],

            ['id' => 207, 'name' => 'uploading-list', 'group_name' => 'uploading'],
            ['id' => 208, 'name' => 'uploading-create', 'group_name' => 'uploading'],
            ['id' => 209, 'name' => 'uploading-edit', 'group_name' => 'uploading'],
            ['id' => 210, 'name' => 'uploading-delete', 'group_name' => 'uploading'],
            ['id' => 211, 'name' => 'uploading-show', 'group_name' => 'uploading'],

            ['id' => 212, 'name' => 'shipment-show', 'group_name' => 'shipment'],
            ['id' => 213, 'name' => 'generate-awb', 'group_name' => 'shipment'],
            ['id' => 214, 'name' => 'change-awb-status', 'group_name' => 'shipment'],

            ['id' => 185, 'name' => 'international-list', 'group_name' => 'manifest'],
            ['id' => 215, 'name' => 'international-create', 'group_name' => 'manifest'],
            ['id' => 216, 'name' => 'international-edit', 'group_name' => 'manifest'],
            ['id' => 217, 'name' => 'international-delete', 'group_name' => 'manifest'],
            ['id' => 218, 'name' => 'international-show', 'group_name' => 'manifest'],

            ['id' => 158, 'name' => 'invoice-list', 'group_name' => 'invoice'],
            ['id' => 159, 'name' => 'invoice-create', 'group_name' => 'invoice'],
            ['id' => 160, 'name' => 'invoice-edit', 'group_name' => 'invoice'],
            ['id' => 161, 'name' => 'invoice-delete', 'group_name' => 'invoice'],
            ['id' => 219, 'name' => 'invoice-weightDifference', 'group_name' => 'invoice'],
            ['id' => 220, 'name' => 'invoice-show', 'group_name' => 'invoice'],
            ['id' => 221, 'name' => 'invoice-payment-status', 'group_name' => 'invoice'],

            ['id' => 222, 'name' => 'rate-list', 'group_name' => 'rate'],
            ['id' => 223, 'name' => 'rate-view', 'group_name' => 'rate'],
            ['id' => 224, 'name' => 'rate-delete', 'group_name' => 'rate'],

            ['id' => 225, 'name' => 'zone-create', 'group_name' => 'zone'],
            ['id' => 226, 'name' => 'zone-list', 'group_name' => 'zone'],
            ['id' => 227, 'name' => 'zone-edit', 'group_name' => 'zone'],
            ['id' => 228, 'name' => 'zone-delete', 'group_name' => 'zone'],

            ['id' => 229, 'name' => 'zone-guide-create', 'group_name' => 'zone-guide'],
            ['id' => 230, 'name' => 'zone-guide-list', 'group_name' => 'zone-guide'],
            ['id' => 231, 'name' => 'zone-guide-import', 'group_name' => 'zone-guide'],

            ['id' => 231, 'name' => 'integrator-create', 'group_name' => 'integrator'],
            ['id' => 233, 'name' => 'integrator-list', 'group_name' => 'integrator'],
            ['id' => 234, 'name' => 'integrator-delete', 'group_name' => 'integrator'],

            ['id' => 235, 'name' => 'change-weight', 'group_name' => 'bill'],
            ['id' => 236, 'name' => 'change-rate', 'group_name' => 'bill'],
            ['id' => 238, 'name' => 'change-overweight-charge', 'group_name' => 'bill'],
            ['id' => 239, 'name' => 'remote-area-delivery', 'group_name' => 'bill'],


            ['id' => 240, 'name' => 'ncc-create', 'group_name' => 'ncc'],
            ['id' => 241, 'name' => 'ncc-list', 'group_name' => 'ncc'],
            ['id' => 242, 'name' => 'ncc-edit', 'group_name' => 'ncc'],
            ['id' => 243, 'name' => 'ncc-delete', 'group_name' => 'ncc'],

            ['id' => 244, 'name' => 'gsp-create', 'group_name' => 'gsp'],
            ['id' => 245, 'name' => 'gsp-list', 'group_name' => 'gsp'],
            ['id' => 246, 'name' => 'gsp-edit', 'group_name' => 'gsp'],
            ['id' => 247, 'name' => 'gsp-delete', 'group_name' => 'gsp'],

            ['id' => 248, 'name' => 'cargo-management', 'group_name' => 'cargo'],


            ['id' => 249, 'name' => 'hbl-create', 'group_name' => 'hbl'],
            ['id' => 250, 'name' => 'hbl-list', 'group_name' => 'hbl'],
            ['id' => 251, 'name' => 'hbl-edit', 'group_name' => 'hbl'],
            ['id' => 252, 'name' => 'hbl-delete', 'group_name' => 'hbl'],

            ['id' => 253, 'name' => 'neffa-create', 'group_name' => 'neffa'],
            ['id' => 254, 'name' => 'neffa-list', 'group_name' => 'neffa'],
            ['id' => 255, 'name' => 'neffa-edit', 'group_name' => 'neffa'],
            ['id' => 256, 'name' => 'neffa-delete', 'group_name' => 'neffa'],

            ['id' => 257, 'name' => 'shipment-recepit', 'group_name' => 'shipment'],

            ['id' => 258, 'name' => 'api-management', 'group_name' => 'api'],

            ['id' => 259, 'name' => 'cargo-invoice-list', 'group_name' => 'cargo-invoice'],
            ['id' => 260, 'name' => 'cargo-invoice-create', 'group_name' => 'cargo-invoice'],
            ['id' => 261, 'name' => 'cargo-invoice-edit', 'group_name' => 'cargo-invoice'],
            ['id' => 262, 'name' => 'cargo-invoice-delete', 'group_name' => 'cargo-invoice'],
            ['id' => 263, 'name' => 'cargo-invoice-weightDifference', 'group_name' => 'cargo-invoice'],
            ['id' => 264, 'name' => 'cargo-invoice-show', 'group_name' => 'cargo-invoice'],
            ['id' => 265, 'name' => 'cargo-invoice-payment-status', 'group_name' => 'cargo-invoice'],
            ['id' => 266, 'name' => 'cargo-invoice-cancel', 'group_name' => 'cargo-invoice'],
            ['id' => 267, 'name' => 'invoice-cancel', 'group_name' => 'invoice'],


        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($permissions as $permission) {
            $menu = new Permission();
            if ($menu->where('id', $permission['id'])->count() > 0) {
                $menu = $menu->where('id', $permission['id'])->first();
            }
            $menu->fill($permission);
            $menu->save();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
