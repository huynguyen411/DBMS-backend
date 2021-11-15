<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type;
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(30),
            'description' => $this->faker->text(),
            'type_id' => Type::pluck('_id')->random(),
            'description' => $this->faker->text(),
            'author' => $this->faker->text(30),
            'publisher' => $this->faker->text(30),
            'publication_year' => rand(1880, 2021),
            'country_id' => Country::pluck('_id')->random(),
            'book_image' => $this->faker->imageUrl(),
        ];
    }
}