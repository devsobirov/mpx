<?php

namespace Database\Seeders;

use App\Helpers\RoleHelper;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        $admin = [
            'name' => 'mmopix',
            'login' => ' mmopix',
            'role' => RoleHelper::ROLE_SUPER_ADMIN,
            'telegram_chat_id' => null,
            'email' => 'fusik@gmail.com',
            'password' => \Hash::make('secret'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $dev = [
            'name' => 'devsobirov',
            'login' => ' devsobirov',
            'role' => RoleHelper::ROLE_ADMIN,
            'telegram_chat_id' => null,
            'email' => 'devsobirov@gmail.com',
            'password' => \Hash::make('secret'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        foreach ([$admin, $dev] as $user) {
            if (!\DB::table('users')->where('email', $user['email'])->exists()) {
                \DB::table('users')->insert($user);
            }
        }
    }
}
