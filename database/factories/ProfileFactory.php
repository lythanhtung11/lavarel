<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'address' => $this->faker->paragraphs(3, 5),
            'birthday' => $this->faker->date(),
            'phone' => rand(1,1000),
            'avatar' => $this->faker->filePath(),
            'user_id' =>  User::factory()->create()->id,
        ];
    }
}
