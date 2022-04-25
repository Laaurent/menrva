<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTypeSeeder::class,
        ]);

        User::create([
            'name' => 'Quenel',
            'first_name' => 'Laurent',
            'user_type_id' => 1,
            'email' => 'laurent-quenel@hotmail.fr',
            'password' => Hash::make('Test1234'),
        ]);

        User::factory()->count(20)->create();
    }
}
