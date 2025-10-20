<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //save(), create(), insert()

        $categories = [
            [
                'name' => 'Theatre',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],

            [
                'name' => 'Events',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Health and Wellness',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ]

        ];

        Category::insert($categories);
    }
}
