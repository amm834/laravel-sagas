<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Leger;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user1 = \App\Models\User::factory()->create([
            'name' => 'Aung Myat Moe',
            'email' => 'aungmyatmoe@gamil.com',
        ]);
        $user1->wallet()->create([
            'currency' => 'MMK',
            'balance' => 1000,
        ]);


        $user2 = \App\Models\User::factory()->create([
            'name' => 'Aye Chan Pyae',
            'email' => 'ayechanpyae@gmail.com'
        ]);
        $user2->wallet()->create([
            'currency' => 'MMK',
            'balance' => 0,
        ]);


        Leger::create([
            'from_user_id' => $user1->id,
            'to_user_id' => $user2->id,
            'amount' => 1000,
            'type' => 'transfer',
            'identifier' => Str::uuid(),
        ]);
    }
}
