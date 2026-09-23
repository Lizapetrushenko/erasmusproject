<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's admin accounts.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Benjamin Netanyahu',
                'email' => 'benjaminnetanyanu@gmail.com',
                'password' => 'ChangeMe123',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@yahoo.com',
                'password' => 'AdminExample',
            ],
        ];

        foreach ($admins as $admin) {
            $user = User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => $admin['password'],
                ]
            );

            // is_admin is deliberately excluded from $fillable to block
            // privilege escalation via mass assignment (e.g. registration).
            $user->forceFill(['is_admin' => true])->save();
        }
    }
}
