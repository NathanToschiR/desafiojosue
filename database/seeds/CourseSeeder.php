<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class, 5)->create();

        $users = App\User::all();

        App\Course::all()->each(function ($course) use ($users){
            $course->users()->attach(
                $users->random(rand(1,3))->pluck('id'),
                );
        });
    }
}
