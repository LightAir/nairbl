<?php

use Illuminate\Database\Seeder;

use App\Models\Posts;
use Badcow\LoremIpsum\Generator;

class MkDataBase extends Seeder {

    /**
     * Generate data for table 'Posts'
     */
    private function postGenerator()
    {

      $generator = new Generator();
      $paragraphs = $generator->getParagraphs(5);

      $text = implode('<p>', $paragraphs);
      $title = substr($text, 0, rand(20, 50));
      $time = date('Y-m-d H:i:s');

      // HACK =))
      preg_match_all('/[\w\s\d]+/u', $title, $slugResult);
      $slug = strtolower(implode('_', explode(' ', implode('', $slugResult[0]))));

        return [
          'title'	=> $title,
          'slug' =>	$slug,
          'text' => $text,
          'is_published' => rand(0,1),
          'is_commentable'	=> rand(0,1),
          'is_visible' => 1,
          'is_favourite' => 0,
          'created_at' => $time,
          'updated_at' =>	$time,
        ];
    }

    public function run()
    {
        $data = [];

        \DB::beginTransaction();

        for ($i=0; $i < 3; $i++) {
            Posts::insert($this->postGenerator());
        }

        \DB::commit();

    }

}
