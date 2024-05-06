<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {
            Post::updateOrCreate([
                'id' => 1,
                'user_id' => '1',
                'category_id' => '1',
                'content' => 'The global warming we should be worried about is the global warming caused by NUCLEAR WEAPONS in the hands of crazy or incompetent leaders!',

            ]);

            Post::updateOrCreate([
                'id' => 2,
                'user_id' => '1',
                'category_id' => '2',
                'content' => 'Pineapple on pizza: bliss or abomination? I am leaning towards atrocity',


            ]);
            Post::updateOrCreate([
                'id' => 3,
                'user_id' => '2',
                'category_id' => '4',

                'content' => 'We hebben de knoop doorgehakt voor wat betreft de kinderopvang. Het wordt Ikea Zuidoost',


            ]);
            Post::updateOrCreate([
                'id' => 4,
                'user_id' => '3',
                'category_id' => '3',
                'content' => 'Net terug van de Ikea, haha potloden stelen enzo',
            ]);
        }
    }
}
