<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Charge;
use App\Models\Course;
use App\Models\Enrollment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
           $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
        ]);

        Charge::create([
            'user_id' => $user1->id,
            'charge_description' => 'Tuition Fee',
            'amount' => 500.00,
        ]);

        $course1 = Course::create([
            'title' => 'Introduction to Programming',
            'description' => 'Learn the basics of programming.',
        ]);

        $course2 = Course::create([
            'title' => 'Web Development Fundamentals',
            'description' => 'Fundamental concepts of web development.',
        ]);

        Enrollment::create([
            'user_id' => $user1->id,
            'course_id' => $course1->id,
            'study_load' => 3,
            'grade' => 90.5,
        ]);

        Enrollment::create([
            'user_id' => $user2->id,
            'course_id' => $course2->id,
            'study_load' => 4,
            'grade' => 85.0,
        ]);
    }
}
