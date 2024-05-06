<?php

namespace Database\Seeders;

use App\Models\SharePost;
use Illuminate\Database\Seeder;



class ShareSeeder extends Seeder
{

    public function run()
    { {
            SharePost::updateOrCreate([
                'id' => 1,
                'post_id' => '1',
                'owner_id' => '1',
                'user_id' => '2',
            ]);

            SharePost::updateOrCreate([
                'id' => 2,
                'post_id' => '2',
                'owner_id' => '1',
                'user_id' => '3',
            ]);
            SharePost::updateOrCreate([
                'id' => 3,
                'post_id' => '3',
                'owner_id' => '2',
                'user_id' => '4',
            ]);
            SharePost::updateOrCreate([
                'id' => 4,
                'post_id' => '4',
                'owner_id' => '3',
                'user_id' => '2',
            ]);
        }
    }
}
