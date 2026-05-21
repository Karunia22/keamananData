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
        User::create([
            'nik'      => '12345678', // Sesuai kolom primary key baru
            'name'     => 'Admin#telkom',
            'email'    => 'admin@example.com',
            'password' => 'telkom#123', // Jangan di-Hash manual karena ada cast 'hashed' di Model
        ]);
    }
}
