<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(['email' => 'test@example.com'], [
            'name' => 'Test User',
            'password' => 'password',
        ]);
        User::updateOrCreate(['email' => 'admin@quizbattle.local'], [
            'name' => 'QuizBattle Admin',
            'password' => 'HrNl-Admin-a794c898c0d48a65!',
        ]);

        $this->call(QuestionSeeder::class);
    }
}