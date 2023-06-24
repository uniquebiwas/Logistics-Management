<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cargo\CertificationOfOriginNCC;

class CertificationOfOriginNCCFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CertificationOfOriginNCC::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference_no' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'exporter_details' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'exporter_registration_no' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'firm_registration_no' => $this->faker->regexify('[A-Za-z0-9]{60}'),
            'place_and_data' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'consignee_details' => $this->faker->regexify('[A-Za-z0-9]{1500}'),
            'transport' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'license_no' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'declaration_name' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'declaration_title' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'declaration_city' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'package_marks' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'description_of_goods' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'value' => $this->faker->regexify('[A-Za-z0-9]{300}'),
            'quantity' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'production' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'invoice_data' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
        ];
    }
}
