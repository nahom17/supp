<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {
            Comment::updateOrCreate([
                'id' => 1,
                'user_id' => '1',
                'post_id' => '1',
                'parent_id' => '1',
                'content' => 'Wat leuk!',

            ]);

            Comment::updateOrCreate([
                'id' => 2,
                'user_id' => '1',
                'post_id' => '1',
                'parent_id' => '1',

                'content' => 'Why are you such a boomer Trump?',


            ]);
            Comment::updateOrCreate([
                'id' => 3,
                'user_id' => '1',
                'post_id' => '2',
                'parent_id' => '1',

                'content' => 'I honestly think that it is quite good',


            ]);
            Comment::updateOrCreate([
                'id' => 4,
                'user_id' => '1',
                'post_id' => '4',
                'parent_id' => '1',

                'content' => 'Ons arrestatieteam is onderweg.',


            ]);
        }
    }
}
