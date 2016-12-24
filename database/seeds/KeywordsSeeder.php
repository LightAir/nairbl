<?php

/**
 * Generate data for table 'Keywords'
 */

use Illuminate\Database\Seeder;

use App\Models\Keywords;

class KeywordsSeeder extends Seeder
{

    public function run()
    {

        Keywords::insert([
            'keyword' => 'Test',
            'route' => 'test',
            'is_favourite' => 0
        ]);

        Keywords::insert([
            'keyword' => 'First',
            'route' => 'first',
            'is_favourite' => 0
        ]);

        Keywords::insert([
            'keyword' => 'Second',
            'route' => 'second',
            'is_favourite' => 0
        ]);

        Keywords::insert([
            'keyword' => 'Fav',
            'route' => 'fav',
            'is_favourite' => 1
        ]);
    }

}
