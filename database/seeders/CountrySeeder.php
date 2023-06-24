<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $countries = [
            [
                "id" => 1,
                "name" => "Afghanistan",
                "country_slug" => "afghanistan",
                "iso_2" => "AF",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 2,
                "name" => "Albania",
                "country_slug" => "albania",
                "iso_2" => "AL",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 3,
                "name" => "Algeria",
                "country_slug" => "algeria",
                "iso_2" => "DZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 4,
                "name" => "American Samoa",
                "country_slug" => "american-samoa",
                "iso_2" => "AS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 5,
                "name" => "Andorra",
                "country_slug" => "andorra",
                "iso_2" => "AD",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 6,
                "name" => "Angola",
                "country_slug" => "angola",
                "iso_2" => "AO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 7,
                "name" => "Anguilla",
                "country_slug" => "anguilla",
                "iso_2" => "AI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 8,
                "name" => "Antigua",
                "country_slug" => "antigua",
                "iso_2" => "AG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 9,
                "name" => "Argentina",
                "country_slug" => "argentina",
                "iso_2" => "AR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 10,
                "name" => "Armenia",
                "country_slug" => "armenia",
                "iso_2" => "AM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 11,
                "name" => "Aruba",
                "country_slug" => "aruba",
                "iso_2" => "AW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 12,
                "name" => "Australia",
                "country_slug" => "australia",
                "iso_2" => "AU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 13,
                "name" => "Austria",
                "country_slug" => "austria",
                "iso_2" => "AT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 14,
                "name" => "Azerbaijan",
                "country_slug" => "azerbaijan",
                "iso_2" => "AZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 15,
                "name" => "Bahamas",
                "country_slug" => "bahamas",
                "iso_2" => "BS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 16,
                "name" => "Bahrain",
                "country_slug" => "bahrain",
                "iso_2" => "BH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 17,
                "name" => "Bangladesh",
                "country_slug" => "bangladesh",
                "iso_2" => "BD",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 18,
                "name" => "Barbados",
                "country_slug" => "barbados",
                "iso_2" => "BB",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 19,
                "name" => "Belarus",
                "country_slug" => "belarus",
                "iso_2" => "BY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 20,
                "name" => "Belgium",
                "country_slug" => "belgium",
                "iso_2" => "BE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 21,
                "name" => "Belize",
                "country_slug" => "belize",
                "iso_2" => "BZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 22,
                "name" => "Benin",
                "country_slug" => "benin",
                "iso_2" => "BJ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 23,
                "name" => "Bermuda",
                "country_slug" => "bermuda",
                "iso_2" => "BM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 24,
                "name" => "Bhutan",
                "country_slug" => "bhutan",
                "iso_2" => "BT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 25,
                "name" => "Bolivia",
                "country_slug" => "bolivia",
                "iso_2" => "BO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 26,
                "name" => "Bonaire",
                "country_slug" => "bonaire",
                "iso_2" => "XB",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 27,
                "name" => "Bosnia",
                "country_slug" => "bosnia",
                "iso_2" => "BA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 28,
                "name" => "Botswana",
                "country_slug" => "botswana",
                "iso_2" => "BW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 29,
                "name" => "Brazil",
                "country_slug" => "brazil",
                "iso_2" => "BR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 30,
                "name" => "Brunei",
                "country_slug" => "brunei",
                "iso_2" => "BN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 31,
                "name" => "Bulgaria",
                "country_slug" => "bulgaria",
                "iso_2" => "BG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 32,
                "name" => "Burkina Faso",
                "country_slug" => "burkina-faso",
                "iso_2" => "BF",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 33,
                "name" => "Burundi",
                "country_slug" => "burundi",
                "iso_2" => "BI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 34,
                "name" => "Cambodia",
                "country_slug" => "cambodia",
                "iso_2" => "KH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 35,
                "name" => "Cameroon",
                "country_slug" => "cameroon",
                "iso_2" => "CM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 36,
                "name" => "Canada",
                "country_slug" => "canada",
                "iso_2" => "CA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 37,
                "name" => "Canary Islands, The",
                "country_slug" => "canary-islands-the",
                "iso_2" => "IC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 38,
                "name" => "Cape Verde",
                "country_slug" => "cape-verde",
                "iso_2" => "CV",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 39,
                "name" => "Cayman Islands",
                "country_slug" => "cayman-islands",
                "iso_2" => "KY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 40,
                "name" => "Central African",
                "country_slug" => "central-african",
                "iso_2" => "CF",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 41,
                "name" => "Chad",
                "country_slug" => "chad",
                "iso_2" => "TD",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 42,
                "name" => "Chile",
                "country_slug" => "chile",
                "iso_2" => "CL",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 43,
                "name" => "China",
                "country_slug" => "china",
                "iso_2" => "CN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 44,
                "name" => "Colombia",
                "country_slug" => "colombia",
                "iso_2" => "CO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 45,
                "name" => "Comoros",
                "country_slug" => "comoros",
                "iso_2" => "KM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 46,
                "name" => "Congo",
                "country_slug" => "congo",
                "iso_2" => "CG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 47,
                "name" => "Congo, DPR",
                "country_slug" => "congo-dpr",
                "iso_2" => "CD",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 48,
                "name" => "Cook Islands",
                "country_slug" => "cook-islands",
                "iso_2" => "CK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 49,
                "name" => "Costa Rica",
                "country_slug" => "costa-rica",
                "iso_2" => "CR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 50,
                "name" => "Cote D Ivoire",
                "country_slug" => "cote-d-ivoire",
                "iso_2" => "CI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 51,
                "name" => "Croatia",
                "country_slug" => "croatia",
                "iso_2" => "HR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 52,
                "name" => "Cuba",
                "country_slug" => "cuba",
                "iso_2" => "CU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 53,
                "name" => "Curacao",
                "country_slug" => "curacao",
                "iso_2" => "XC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 54,
                "name" => "Cyprus",
                "country_slug" => "cyprus",
                "iso_2" => "CY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 55,
                "name" => "Czech Rep., The",
                "country_slug" => "czech-rep-the",
                "iso_2" => "CZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 56,
                "name" => "Denmark",
                "country_slug" => "denmark",
                "iso_2" => "DK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 57,
                "name" => "Djibouti",
                "country_slug" => "djibouti",
                "iso_2" => "DJ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 58,
                "name" => "Dominica",
                "country_slug" => "dominica",
                "iso_2" => "DM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 59,
                "name" => "Dominican Rep.",
                "country_slug" => "dominican-rep",
                "iso_2" => "DO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 60,
                "name" => "East Timor",
                "country_slug" => "east-timor",
                "iso_2" => "TL",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 61,
                "name" => "Ecuador",
                "country_slug" => "ecuador",
                "iso_2" => "EC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 62,
                "name" => "Egypt",
                "country_slug" => "egypt",
                "iso_2" => "EG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 63,
                "name" => "El Salvador",
                "country_slug" => "el-salvador",
                "iso_2" => "SV",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 64,
                "name" => "Eritrea",
                "country_slug" => "eritrea",
                "iso_2" => "ER",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 65,
                "name" => "Estonia",
                "country_slug" => "estonia",
                "iso_2" => "EE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 66,
                "name" => "Ethiopia",
                "country_slug" => "ethiopia",
                "iso_2" => "ET",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 67,
                "name" => "Falkland Islands",
                "country_slug" => "falkland-islands",
                "iso_2" => "FK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 68,
                "name" => "Faroe Islands",
                "country_slug" => "faroe-islands",
                "iso_2" => "FO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 69,
                "name" => "Fiji",
                "country_slug" => "fiji",
                "iso_2" => "FJ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 70,
                "name" => "Finland",
                "country_slug" => "finland",
                "iso_2" => "FI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 71,
                "name" => "France",
                "country_slug" => "france",
                "iso_2" => "FR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 72,
                "name" => "French Guyana",
                "country_slug" => "french-guyana",
                "iso_2" => "GF",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 73,
                "name" => "Gabon",
                "country_slug" => "gabon",
                "iso_2" => "GA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 74,
                "name" => "Gambia",
                "country_slug" => "gambia",
                "iso_2" => "GM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 75,
                "name" => "Georgia",
                "country_slug" => "georgia",
                "iso_2" => "GE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 76,
                "name" => "Germany",
                "country_slug" => "germany",
                "iso_2" => "DE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 77,
                "name" => "Ghana",
                "country_slug" => "ghana",
                "iso_2" => "GH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 78,
                "name" => "Gibraltar",
                "country_slug" => "gibraltar",
                "iso_2" => "GI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 79,
                "name" => "Greece",
                "country_slug" => "greece",
                "iso_2" => "GR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 80,
                "name" => "Greenland",
                "country_slug" => "greenland",
                "iso_2" => "GL",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 81,
                "name" => "Grenada",
                "country_slug" => "grenada",
                "iso_2" => "GD",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 82,
                "name" => "Guadeloupe",
                "country_slug" => "guadeloupe",
                "iso_2" => "GP",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 83,
                "name" => "Guam",
                "country_slug" => "guam",
                "iso_2" => "GU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 84,
                "name" => "Guatemala",
                "country_slug" => "guatemala",
                "iso_2" => "GT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 85,
                "name" => "Guernsey",
                "country_slug" => "guernsey",
                "iso_2" => "GG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 86,
                "name" => "Guinea Rep.",
                "country_slug" => "guinea-rep",
                "iso_2" => "GN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 87,
                "name" => "Guinea-Bissau",
                "country_slug" => "guinea-bissau",
                "iso_2" => "GW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 88,
                "name" => "Guinea-Equatorial",
                "country_slug" => "guinea-equatorial",
                "iso_2" => "GQ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 89,
                "name" => "Guyana (British)",
                "country_slug" => "guyana-british",
                "iso_2" => "GY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 90,
                "name" => "Haiti",
                "country_slug" => "haiti",
                "iso_2" => "HT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 91,
                "name" => "Honduras",
                "country_slug" => "honduras",
                "iso_2" => "HN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 92,
                "name" => "Hong Kong",
                "country_slug" => "hong-kong",
                "iso_2" => "HK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 93,
                "name" => "Hungary",
                "country_slug" => "hungary",
                "iso_2" => "HU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 94,
                "name" => "Iceland",
                "country_slug" => "iceland",
                "iso_2" => "IS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 95,
                "name" => "India",
                "country_slug" => "india",
                "iso_2" => "IN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 96,
                "name" => "Indonesia",
                "country_slug" => "indonesia",
                "iso_2" => "ID",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 97,
                "name" => "Iran",
                "country_slug" => "iran",
                "iso_2" => "IR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 98,
                "name" => "Iraq",
                "country_slug" => "iraq",
                "iso_2" => "IQ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 99,
                "name" => "Israel",
                "country_slug" => "israel",
                "iso_2" => "IS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 100,
                "name" => "Ireland, Rep. Of",
                "country_slug" => "ireland-rep-of",
                "iso_2" => "IE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 101,
                "name" => "Italy",
                "country_slug" => "italy",
                "iso_2" => "IT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 102,
                "name" => "Jamaica",
                "country_slug" => "jamaica",
                "iso_2" => "JM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 103,
                "name" => "Japan",
                "country_slug" => "japan",
                "iso_2" => "JP",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 104,
                "name" => "Jersey",
                "country_slug" => "jersey",
                "iso_2" => "JE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 105,
                "name" => "Jordan",
                "country_slug" => "jordan",
                "iso_2" => "JO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 106,
                "name" => "Kazakhstan",
                "country_slug" => "kazakhstan",
                "iso_2" => "KZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 107,
                "name" => "Kenya",
                "country_slug" => "kenya",
                "iso_2" => "KE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 108,
                "name" => "Kiribati",
                "country_slug" => "kiribati",
                "iso_2" => "KI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 109,
                "name" => "Korea,  D.P.R Of",
                "country_slug" => "korea-dpr-of",
                "iso_2" => "KP",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 110,
                "name" => "Korea, Rep. Of",
                "country_slug" => "korea-rep-of",
                "iso_2" => "KR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 111,
                "name" => "Kosovo",
                "country_slug" => "kosovo",
                "iso_2" => "KV",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 112,
                "name" => "Kuwait",
                "country_slug" => "kuwait",
                "iso_2" => "KW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 113,
                "name" => "Kyrgyzstan",
                "country_slug" => "kyrgyzstan",
                "iso_2" => "KG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 114,
                "name" => "Laos",
                "country_slug" => "laos",
                "iso_2" => "LA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 115,
                "name" => "Latvia",
                "country_slug" => "latvia",
                "iso_2" => "LV",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 116,
                "name" => "Lebanon",
                "country_slug" => "lebanon",
                "iso_2" => "LB",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 117,
                "name" => "Lesotho",
                "country_slug" => "lesotho",
                "iso_2" => "LS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 118,
                "name" => "Liberia",
                "country_slug" => "liberia",
                "iso_2" => "LR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 119,
                "name" => "Libya",
                "country_slug" => "libya",
                "iso_2" => "LY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 120,
                "name" => "Liechtenstein",
                "country_slug" => "liechtenstein",
                "iso_2" => "LI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 121,
                "name" => "Lithuania",
                "country_slug" => "lithuania",
                "iso_2" => "LT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 122,
                "name" => "Luxembourg",
                "country_slug" => "luxembourg",
                "iso_2" => "LU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 123,
                "name" => "Macau",
                "country_slug" => "macau",
                "iso_2" => "MO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 124,
                "name" => "Madagascar",
                "country_slug" => "madagascar",
                "iso_2" => "MG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 125,
                "name" => "Malawi",
                "country_slug" => "malawi",
                "iso_2" => "MW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 126,
                "name" => "Malaysia",
                "country_slug" => "malaysia",
                "iso_2" => "MY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 127,
                "name" => "Maldives",
                "country_slug" => "maldives",
                "iso_2" => "MV",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 128,
                "name" => "Mali",
                "country_slug" => "mali",
                "iso_2" => "ML",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 129,
                "name" => "Malta",
                "country_slug" => "malta",
                "iso_2" => "MT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 130,
                "name" => "Mariana Islands",
                "country_slug" => "mariana-islands",
                "iso_2" => "MP",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 131,
                "name" => "Marshall Islands",
                "country_slug" => "marshall-islands",
                "iso_2" => "MH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 132,
                "name" => "Martinique",
                "country_slug" => "martinique",
                "iso_2" => "MQ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 133,
                "name" => "Mauritania",
                "country_slug" => "mauritania",
                "iso_2" => "MR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 134,
                "name" => "Mauritius",
                "country_slug" => "mauritius",
                "iso_2" => "MU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 135,
                "name" => "Mayotte",
                "country_slug" => "mayotte",
                "iso_2" => "YT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 136,
                "name" => "Mexico",
                "country_slug" => "mexico",
                "iso_2" => "MX",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 137,
                "name" => "Micronesia",
                "country_slug" => "micronesia",
                "iso_2" => "FM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 138,
                "name" => "Moldova, Rep. Of",
                "country_slug" => "moldova-rep-of",
                "iso_2" => "MD",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 139,
                "name" => "Monaco",
                "country_slug" => "monaco",
                "iso_2" => "MC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 140,
                "name" => "Mongolia",
                "country_slug" => "mongolia",
                "iso_2" => "MN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 141,
                "name" => "Montenegro, Rep Of",
                "country_slug" => "montenegro-rep-of",
                "iso_2" => "ME",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 142,
                "name" => "Montserrat",
                "country_slug" => "montserrat",
                "iso_2" => "MS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 143,
                "name" => "Morocco",
                "country_slug" => "morocco",
                "iso_2" => "MA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 144,
                "name" => "Mozambique",
                "country_slug" => "mozambique",
                "iso_2" => "MZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 145,
                "name" => "Myanmar",
                "country_slug" => "myanmar",
                "iso_2" => "MM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 146,
                "name" => "Namibia",
                "country_slug" => "namibia",
                "iso_2" => "NA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 147,
                "name" => "Nauru, Rep. Of",
                "country_slug" => "nauru-rep-of",
                "iso_2" => "NR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 148,
                "name" => "Nepal",
                "country_slug" => "nepal",
                "iso_2" => "NP",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 149,
                "name" => "Netherlands, The",
                "country_slug" => "netherlands-the",
                "iso_2" => "NL",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 150,
                "name" => "Nevis",
                "country_slug" => "nevis",
                "iso_2" => "XN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 151,
                "name" => "New Caledonia",
                "country_slug" => "new-caledonia",
                "iso_2" => "NC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 152,
                "name" => "New Zealand",
                "country_slug" => "new-zealand",
                "iso_2" => "NZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 153,
                "name" => "Nicaragua",
                "country_slug" => "nicaragua",
                "iso_2" => "NI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 154,
                "name" => "Niger",
                "country_slug" => "niger",
                "iso_2" => "NE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 155,
                "name" => "Nigeria",
                "country_slug" => "nigeria",
                "iso_2" => "NG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 156,
                "name" => "Niue",
                "country_slug" => "niue",
                "iso_2" => "NU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 157,
                "name" => "North Macedonia",
                "country_slug" => "north-macedonia",
                "iso_2" => "MK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 158,
                "name" => "Norway",
                "country_slug" => "norway",
                "iso_2" => "NO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 159,
                "name" => "Oman",
                "country_slug" => "oman",
                "iso_2" => "OM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 160,
                "name" => "Pakistan",
                "country_slug" => "pakistan",
                "iso_2" => "PK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 161,
                "name" => "Palau",
                "country_slug" => "palau",
                "iso_2" => "PW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 162,
                "name" => "Panama",
                "country_slug" => "panama",
                "iso_2" => "PA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 163,
                "name" => "Papua New Guinea",
                "country_slug" => "papua-new-guinea",
                "iso_2" => "PG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 164,
                "name" => "Paraguay",
                "country_slug" => "paraguay",
                "iso_2" => "PY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 165,
                "name" => "Peru",
                "country_slug" => "peru",
                "iso_2" => "PE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 166,
                "name" => "Philippines, The",
                "country_slug" => "philippines-the",
                "iso_2" => "PH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 167,
                "name" => "Poland",
                "country_slug" => "poland",
                "iso_2" => "PL",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 168,
                "name" => "Portugal",
                "country_slug" => "portugal",
                "iso_2" => "PT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 169,
                "name" => "Puerto Rico",
                "country_slug" => "puerto-rico",
                "iso_2" => "PR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 170,
                "name" => "Qatar",
                "country_slug" => "qatar",
                "iso_2" => "QA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 171,
                "name" => "Reunion, Island Of",
                "country_slug" => "reunion-island-of",
                "iso_2" => "RE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 172,
                "name" => "Romania",
                "country_slug" => "romania",
                "iso_2" => "RO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 173,
                "name" => "Russian Federation",
                "country_slug" => "russian-federation",
                "iso_2" => "RU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 174,
                "name" => "Rwanda",
                "country_slug" => "rwanda",
                "iso_2" => "RW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 175,
                "name" => "Saint Helena",
                "country_slug" => "saint-helena",
                "iso_2" => "SH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 176,
                "name" => "Samoa",
                "country_slug" => "samoa",
                "iso_2" => "WS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 177,
                "name" => "San Marino",
                "country_slug" => "san-marino",
                "iso_2" => "SM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 178,
                "name" => "Sao Tome And Principe",
                "country_slug" => "sao-tome-and-principe",
                "iso_2" => "ST",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 179,
                "name" => "Saudi Arabia",
                "country_slug" => "saudi-arabia",
                "iso_2" => "SA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 180,
                "name" => "Senegal",
                "country_slug" => "senegal",
                "iso_2" => "SN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 181,
                "name" => "Serbia, Rep. Of",
                "country_slug" => "serbia-rep-of",
                "iso_2" => "RS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 182,
                "name" => "Seychelles",
                "country_slug" => "seychelles",
                "iso_2" => "SC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 183,
                "name" => "Sierra Leone",
                "country_slug" => "sierra-leone",
                "iso_2" => "SL",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 184,
                "name" => "Singapore",
                "country_slug" => "singapore",
                "iso_2" => "SG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 185,
                "name" => "Slovakia",
                "country_slug" => "slovakia",
                "iso_2" => "SK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 186,
                "name" => "Slovenia",
                "country_slug" => "slovenia",
                "iso_2" => "SI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 187,
                "name" => "Solomon Islands",
                "country_slug" => "solomon-islands",
                "iso_2" => "SB",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 188,
                "name" => "Somalia",
                "country_slug" => "somalia",
                "iso_2" => "SO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 189,
                "name" => "Somaliland, Rep Of",
                "country_slug" => "somaliland-rep-of",
                "iso_2" => "XS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 190,
                "name" => "South Africa",
                "country_slug" => "south-africa",
                "iso_2" => "ZA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 191,
                "name" => "South Sudan",
                "country_slug" => "south-sudan",
                "iso_2" => "SS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 192,
                "name" => "Spain",
                "country_slug" => "spain",
                "iso_2" => "ES",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 193,
                "name" => "Sri Lanka",
                "country_slug" => "sri-lanka",
                "iso_2" => "LK",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 194,
                "name" => "St. Barthelemy",
                "country_slug" => "st-barthelemy",
                "iso_2" => "XY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 195,
                "name" => "St. Eustatius",
                "country_slug" => "st-eustatius",
                "iso_2" => "XE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 196,
                "name" => "St. Kitts",
                "country_slug" => "st-kitts",
                "iso_2" => "KN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 197,
                "name" => "St. Lucia",
                "country_slug" => "st-lucia",
                "iso_2" => "LC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 198,
                "name" => "St. Maarten",
                "country_slug" => "st-maarten",
                "iso_2" => "XM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 199,
                "name" => "St. Vincent",
                "country_slug" => "st-vincent",
                "iso_2" => "VC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 200,
                "name" => "Sudan",
                "country_slug" => "sudan",
                "iso_2" => "SD",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 201,
                "name" => "Suriname",
                "country_slug" => "suriname",
                "iso_2" => "SR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 202,
                "name" => "Swaziland",
                "country_slug" => "swaziland",
                "iso_2" => "SZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 203,
                "name" => "Sweden",
                "country_slug" => "sweden",
                "iso_2" => "SE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 204,
                "name" => "Switzerland",
                "country_slug" => "switzerland",
                "iso_2" => "CH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 205,
                "name" => "Syria",
                "country_slug" => "syria",
                "iso_2" => "SY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 206,
                "name" => "Tahiti",
                "country_slug" => "tahiti",
                "iso_2" => "PF",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 207,
                "name" => "Taiwan",
                "country_slug" => "taiwan",
                "iso_2" => "TW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 208,
                "name" => "Tajikistan",
                "country_slug" => "tajikistan",
                "iso_2" => "TJ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 209,
                "name" => "Tanzania",
                "country_slug" => "tanzania",
                "iso_2" => "TZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 210,
                "name" => "Thailand",
                "country_slug" => "thailand",
                "iso_2" => "TH",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 211,
                "name" => "Togo",
                "country_slug" => "togo",
                "iso_2" => "TG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 212,
                "name" => "Tonga",
                "country_slug" => "tonga",
                "iso_2" => "TO",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 213,
                "name" => "Trinidad And Tobago",
                "country_slug" => "trinidad-and-tobago",
                "iso_2" => "TT",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 214,
                "name" => "Tunisia",
                "country_slug" => "tunisia",
                "iso_2" => "TN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 215,
                "name" => "Turkey",
                "country_slug" => "turkey",
                "iso_2" => "TR",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 216,
                "name" => "Turkmenistan",
                "country_slug" => "turkmenistan",
                "iso_2" => "TM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 217,
                "name" => "Turks & Caicos",
                "country_slug" => "turks-caicos",
                "iso_2" => "TC",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 218,
                "name" => "Tuvalu",
                "country_slug" => "tuvalu",
                "iso_2" => "TV",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 219,
                "name" => "Uganda",
                "country_slug" => "uganda",
                "iso_2" => "UG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 220,
                "name" => "Ukraine",
                "country_slug" => "ukraine",
                "iso_2" => "UA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 221,
                "name" => "United Kingdom",
                "country_slug" => "united-kingdom",
                "iso_2" => "GB",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 222,
                "name" => "Uruguay",
                "country_slug" => "uruguay",
                "iso_2" => "UY",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 223,
                "name" => "USA",
                "country_slug" => "usa",
                "iso_2" => "US",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 224,
                "name" => "Uzbekistan",
                "country_slug" => "uzbekistan",
                "iso_2" => "UZ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 225,
                "name" => "Vanuatu",
                "country_slug" => "vanuatu",
                "iso_2" => "VU",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 226,
                "name" => "Vatican City",
                "country_slug" => "vatican-city",
                "iso_2" => "VA",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 227,
                "name" => "Venezuela",
                "country_slug" => "venezuela",
                "iso_2" => "VE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 228,
                "name" => "Vietnam",
                "country_slug" => "vietnam",
                "iso_2" => "VN",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 229,
                "name" => "Virgin Islands-British",
                "country_slug" => "virgin-islands-british",
                "iso_2" => "VG",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 230,
                "name" => "Virgin Islands-US",
                "country_slug" => "virgin-islands-us",
                "iso_2" => "VI",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 231,
                "name" => "Yemen, Rep. Of",
                "country_slug" => "yemen-rep-of",
                "iso_2" => "YE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 232,
                "name" => "Zambia",
                "country_slug" => "zambia",
                "iso_2" => "ZM",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 233,
                "name" => "Zimbabwe",
                "country_slug" => "zimbabwe",
                "iso_2" => "ZW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 234,
                "name" => "United Arab Emirates",
                "country_slug" => "united-arab-emirates",
                "iso_2" => "AE",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 235,
                "name" => "Wallis & Futuna",
                "country_slug" => "wallis-futuna",
                "iso_2" => "WF",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 236,
                "name" => "St Maarten fedex",
                "country_slug" => "st-marten",
                "iso_2" => "SX",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 237,
                "name" => "St Martin",
                "country_slug" => "st-martin",
                "iso_2" => "MF",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 238,
                "name" => "Palestine Autonomous",
                "country_slug" => "palestine-autonomous",
                "iso_2" => "PS",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>13",
                "updated_at" => "2021-09-12 12=>20=>13"
            ],
            [
                "id" => 239,
                "name" => "Curacao fedex",
                "country_slug" => "curacao-fedex",
                "iso_2" => "CW",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
            [
                "id" => 240,
                "name" => "Bonaire fedex",
                "country_slug" => "bonaire-fedex",
                "iso_2" => "BQ",
                "code" => null,
                "status" => "Active",
                "created_at" => "2021-09-12 12=>20=>12",
                "updated_at" => "2021-09-12 12=>20=>12"
            ],
        ];
        Schema::disableForeignKeyConstraints();
        DB::table('countries')->truncate();
        DB::table('countries')->insert($countries);
        Schema::enableForeignKeyConstraints();
    }
}
