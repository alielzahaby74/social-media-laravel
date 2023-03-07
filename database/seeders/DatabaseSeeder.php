<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Follower;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        for ($i = 1; $i < 10; $i++) {
            Post::factory()->create([
                'user_id' => $i
            ]);
        }
        for ($i = 1; $i < 10; $i++) {
            Post::factory(20)->create([
                'user_id' => $i
            ]);
        }

        for ($i = 1; $i < 6; $i++) {
            for ($j = 1; $j < 6; $j++) {
                if($i == $j)    continue;
                Follower::create([
                    'user_id' => $i,
                    'follow_id' => $j
                ]);
            }
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
