<?php

namespace App\Traits\Admin;

/**
 *
 */
trait AppSettingTrait
{
    protected function mapAppSettingData($request, $appsetting = null)
    {

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->contact_no,

            'is_favicon' => $request->is_favicon,
            'twitter' => $request->twitter,
            'registration_number' => $request->registration_number,
            'registration_date' => $request->registration_date,

            'facebook' => $request->facebook,
            'youtube' => $request->youtube,

            'otp_expire' => $request->otp_expire,

            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'is_meta' => $request->is_meta,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_key,
            'meta_description' => $request->meta_desc,
            'footer_description' => $request->footer_description,
            'front_counter_description' => $request->front_counter_description,
            'front_testimonial_description' => $request->front_testimonial_description,
            "banner_news" => $request->banner_news,
            "is_startup_ad" => $request->is_startup_ad,
            "startup_ad_number" => $request->startup_ad_number,
            "min_agent_balance" => $request->min_agent_balance,
            "term_con_link" => $request->term_con_link,
            "pan" => $request->pan,
            "tiaCharge" => $request->tiaCharge
        ];
        // dd($request->contact_no);
        $data['contact_no'] = $request->contact_no;

        if ($request->logo_url && !empty($request->logo_url)) {
            $data['logo_url'] = $request->logo_url;
        }
        $data['logo'] = $request->logo;
        if ($request->favicon) {
            $data['favicon'] = $request->favicon ?? '';
        }
        if ($request->og_image) {
            $og_image_name = get_image_url($request->og_image);
            if ($og_image_name) {
                $data['og_image'] = $og_image_name;
            }
        }

        return $data;
    }
}
