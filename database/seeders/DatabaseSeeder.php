<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
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
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@' . strtolower(env('COMPANY')) . '.com'
        ]);
        $admin->ownedTeams()->save(Team::forceCreate([
            'user_id' => $admin->id,
            'name' => 'System Administrators',
            'personal_team' => true,
        ]));

        $manager = User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@' . strtolower(env('COMPANY')) . '.com'
        ]);
        $manager->ownedTeams()->save(Team::forceCreate([
            'user_id' => $manager->id,
            'name' => env('COMPANY') . ' Global',
            'global_team' => true,
        ]));

        $this->call([
            UserSeeder::class,
            TeamSeeder::class
        ]);

    }
}
