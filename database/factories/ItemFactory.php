<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => json_encode([
                'en' => $this->faker->word,
                'ar' => $this->faker->word,
                'de' => $this->faker->word,
            ]),
            'selected_image' => 'default_image.png',
            'description' => json_encode([
                'en' => $this->faker->sentence,
                'ar' => $this->faker->sentence,
                'de' => $this->faker->sentence,
            ]),
            'unit' => json_encode([
                'en' => 'piece',
                'ar' => 'pièce',
                'de' => 'pieza',
            ]),
            'barcode' => $this->faker->unique()->numerify('##########'),
            'barcodeimage' => 'default_barcode.png',
            'units_number' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'min' => $this->faker->numberBetween(1, 10),
            'max' => $this->faker->numberBetween(10, 100),
            'unit_price' => $this->faker->randomFloat(2, 10, 100),
            'total_price' => $this->faker->randomFloat(2, 100, 1000),
            'image' => 'default_item.png',
            'tax' => $this->faker->numberBetween(0, 15),
            
            'admin_id' => 1, // Replace with appropriate admin ID
            'editor_id' => 1, // Replace with appropriate editor ID
        ];
    }
    
    
    
}
