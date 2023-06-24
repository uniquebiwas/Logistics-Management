<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reporter;
use Illuminate\Support\Str;

class ReporterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reporter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $img_data = [
            'https://capitalnepal.com/beta/uploads/Deependra-bahadur.jpg',
            'https://source.unsplash.com/bUVwWCSiDss',
            'https://source.unsplash.com/9sgaZwWw-WA',
            'https://source.unsplash.com/XVOBr3F95RY',
            'https://source.unsplash.com/dFEls-KSI9A',
            'https://source.unsplash.com/St2zVK-Q_mU',
        ];
        $name = $this->faker->name;
        return [

            'name'=>[
                "np"=>$name,
                "en"=>$name
            ],
            'slug'=>Str::slug($name),
            'slug_url'=>Str::slug($name),
            'email'=>$this->faker->email,
            'user_id' => rand(1,2),
            "phone"=>$this->faker->phoneNumber,
            "profile_image_url"=> $img_data[rand(0, 5)],
        ];
    }
}
