<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\QuestionBank;

class QuestionBanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                'name'  => 'General',
                'slug' => Str::slug('General'),
            ],
            [
             'name'  => 'MS Excel',
             'slug' => Str::slug('MS Excel'),
            ],
            [
             'name'  => 'MS Powerpoint',
             'slug' => Str::slug('MS Powerpoint'),
            ],
            [
             'name'  => 'Power BI',
             'slug' => Str::slug('Power BI'),
            ],
            [
             'name'  => 'Stakeholder / Conflict Management',
             'slug' => Str::slug('Stakeholder / Conflict Management'),
            ],
            [
             'name'  => 'Presentation Skills',
             'slug' => Str::slug('Presentation Skills'),
            ],
            [
             'name'  => 'Analytical Skills',
             'slug' => Str::slug('Analytical Skills'),
            ],
            [
             'name'  => 'Forecasting Skills',
             'slug' => Str::slug('Forecasting Skills'),
            ],
        ];

        foreach($banks as $bank){
            QuestionBank::create($bank);
        }
    }
}
