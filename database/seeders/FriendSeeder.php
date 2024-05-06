<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Friend;

class FriendSeeder extends Seeder
{

    public function run()
    { {
            Friend::updateOrCreate([
                'id' => 1,
                'user_id' => '1',
                'friend_id' => '2',
                'accepted' => 0
            ]);

            Friend::updateOrCreate([
                'id' => 2,
                'user_id' => '2',
                'friend_id' => '3',
                'accepted' => 0
            ]);
            Friend::updateOrCreate([
                'id' => 3,
                'user_id' => '1',
                'friend_id' => '3',
                'accepted' => 1
            ]);
            Friend::updateOrCreate([
                'id' => 4,
                'user_id' => '3',
                'friend_id' => '4',
                'accepted' => 1
            ]);
        }
    }
}
