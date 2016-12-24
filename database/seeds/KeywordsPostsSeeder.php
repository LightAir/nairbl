<?php
/**
 * Generate data for table 'KeywordsPosts'
 */

use Illuminate\Database\Seeder;

use App\Models\KeywordsPosts;

class KeywordsPostsSeeder extends Seeder
{

    public function run()
    {
        KeywordsPosts::insert([
            'posts_id' => 1,
            'keywords_id' => 1
        ]);

        KeywordsPosts::insert([
            'posts_id' => 1,
            'keywords_id' => 4
        ]);

        KeywordsPosts::insert([
            'posts_id' => 4,
            'keywords_id' => 5
        ]);
    }

}
