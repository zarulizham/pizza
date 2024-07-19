<?php

namespace Database\Seeders;

use App\Models\Pizza;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pizza::reguard();

        $pizza = Pizza::updateOrCreate([
            'name' => 'Pizza Homemade',
        ]);

        $pizza->toppings()->create([
            'name' => 'Extra Cheese',
            'price' => 6,
        ]);

        $sizes = [
            [
                'pizza_id' => 1,
                'name' => 'Small',
                'price' => '15',
                'toppings' => [
                    [
                        'name' => 'Pepperoni',
                        'price' => 3,
                    ],
                ],
            ], [
                'pizza_id' => 1,
                'name' => 'Medium',
                'price' => '22',
                'toppings' => [
                    [
                        'name' => 'Pepperoni',
                        'price' => 5,
                    ],
                ],
            ], [
                'pizza_id' => 1,
                'name' => 'Large',
                'price' => '30',
            ],
        ];

        foreach ($sizes as $data) {
            $size = $pizza->sizes()->create(Arr::only($data, ['name', 'price']));

            foreach ($data['toppings'] ?? [] as $dataTopping) {
                $size->toppings()->create($dataTopping);
            }
        }

    }
}
