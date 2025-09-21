<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Carausel;
use App\Models\Program;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Carausel::class);
        $this->call(Program::class);
        $this->call(Activity::class);
        $this->call([
            EducationContentSeeder::class,
            EducationContentImageSeeder::class,
        ]);
        $this->call(MealScheduleSeeder::class);
        $this->call(AccountSeeder::class);
    }
    //php artisan db:seed --class=MealScheduleSeeder
}
