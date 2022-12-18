<?php

namespace Database\Seeders;

use App\Models\ResourceTypeSetting;
use App\Utils\Common\ResourceTypes;
use Illuminate\Database\Seeder;

class ResourceTypeSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'key'       => "height",
                'value'     => '100',
                'type'      => ResourceTypes::IMAGE,
            ],
            [
                'key'       => "width",
                'value'     => '200',
                'type'      => ResourceTypes::IMAGE,
            ],
            [
                'key'       => "class",
                'value'     => 'bold',
                'type'      => ResourceTypes::FILE,
            ]
        ];

        ResourceTypeSetting::insert($settings);
    }
}
