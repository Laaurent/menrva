<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Formation;
use App\Models\Experience;
use Illuminate\Database\Seeder;
use Database\Seeders\UserTypeSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
            'name' => 'Henry',
            'first_name' => 'Latour',
            'user_type_id' => 1,
            'email' => 'email@student.fr',
            'password' => Hash::make('Test1234'),
        ]);
        User::create([
            'name' => 'Jean',
            'first_name' => 'Hagrah',
            'user_type_id' => 2,
            'email' => 'email@pro.fr',
            'password' => Hash::make('Test1234'),
        ]);

        if (!Storage::disk('public')->exists("/avatars/1/avatar.png") && !Storage::disk('public')->exists("/avatars/1/background.png")) {
            Storage::disk('public')->copy("/avatars/avatar.png", "/avatars/1/avatar.png");
            Storage::disk('public')->copy('/avatars/background.png', "/avatars/1/background.png");
        }



        $users = User::factory()->count(20)->has(
            Experience::factory()->count(5)
        )->has(
            Formation::factory()->count(5)
        )->create();

        $users->each(function ($user) {
            if (!Storage::disk('public')->exists("/avatars/$user->id/avatar.png") && !Storage::disk('public')->exists("/avatars/$user->id/background.png")) {
                Storage::disk('public')->copy('/avatars/avatar.png', "/avatars/$user->id/avatar.png");
                Storage::disk('public')->copy('/avatars/background.png', "/avatars/$user->id/background.png");
            }
        });
    }
}
