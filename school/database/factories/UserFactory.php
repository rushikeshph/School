<?php

namespace Database\Factories;
use App\Models\Cources;
use App\Models\User;
use App\Models\Teachers;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];

        $factory->define(App\Models\Courses::class, function (Faker\Generator $faker) {
            return [
               "title" => $faker->title,
               "description" => $faker->sentenec(4),
               "value" => $faker->value,
               "teacher_id"=> rand(1,50)

            ];
        });
        $factory->define(App\Models\Teachers::class, function (Faker\Generator $faker) {
            return [
               "teacher_id"=> rand(1,50)

            ];
        });
    }
}
