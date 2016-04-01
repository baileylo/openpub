<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Logan Bailey',
            'email' => 'logan@logansbailey.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ])->each(function (App\User $user) {
            factory(App\Post::class)->times(50)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
