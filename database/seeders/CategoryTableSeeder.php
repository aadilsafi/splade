<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
                'name'          => 'Technical Trainings',
                'slug'          => 'technical-trainings',
                'parent_id'     =>  null,
                'position'      => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Staff Trainings',
                'slug'          => 'staff-skills',
                'parent_id'     =>  null,
                'position'      => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Product Training',
                'slug'          => 'product-training',
                'parent_id'     => 1,
                'position'      => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Sales Training',
                'slug'          => 'sales-training',
                'parent_id'     => 1,
                'position'      => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Orientation Training',
                'slug'          => 'orientation-training',
                'parent_id'     => 2,
                'position'      => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Soft Skills',
                'slug'          => 'soft-skills',
                'parent_id'     => 2,
                'position'      => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Compliance Training',
                'slug'          => 'compliance-training',
                'parent_id'     => 2,
                'position'      => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Quality Assurance',
                'slug'          => 'quality-assurance',
                'parent_id'     => 3,
                'position'      => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],

        ];
        Category::insert($categories);
    }
}
