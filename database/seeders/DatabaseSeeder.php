<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        Storage::copy('public/avatars/avatar.png', "public/avatars/1/avatar.png");
        Storage::copy('public/avatars/background.png', "public/avatars/1/background.png");

        $users = User::factory()->count(20)->create();

        $users->each(function ($user) {
            Storage::copy('public/avatars/avatar.png', "public/avatars/$user->id/avatar.png");
            Storage::copy('public/avatars/background.png', "public/avatars/$user->id/background.png");
        });
    }
}
