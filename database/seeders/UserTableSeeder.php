<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAd = fake()->dateTimeBetween('-3 months', '-2 months');
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_unknown@g.g',
                'email_verified_at' => now(),
                'password' => bcrypt(fake()->password()),
                'remember_token' => Str::random(10),
                'created_at' => $createdAd,
                'updated_at' => $createdAd,
            ],
            [
                'name' => 'Автор',
                'email' => 'author1@g.g',
                'email_verified_at' => now(),
                'password' => bcrypt('123123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
