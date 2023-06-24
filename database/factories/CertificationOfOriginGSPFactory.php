<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cargo\CertificationOfOriginGSP;

class CertificationOfOriginGSPFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CertificationOfOriginGSP::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'issued_address' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'reference_no' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'exporter_details' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'consignee_details' => $this->faker->regexify('[A-Za-z0-9]{1500}'),
            'transport' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'official_use' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'declaration_name' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'declaration_title' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'declaration_city' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'item_no' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'package_marks' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'description_of_goods' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'origin' => $this->faker->regexify('[A-Za-z0-9]{300}'),
            'gross_weight' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'invoice_data' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'produced_country' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'importing_country' => $this->faker->word,
            'exporter_signature' => $this->faker->word,
        ];
    }
}
