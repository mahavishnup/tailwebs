<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @throws RandomException
     */
    public function run(): void
    {
        User::factory()
            ->has(Student::factory(random_int(2, 7)), 'students')
            ->count(random_int(2, 5))
            ->create();
    }
}
