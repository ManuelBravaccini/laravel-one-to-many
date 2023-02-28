<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 50; $i++) { 
            $newProject = new Project();
            $newProject->title = $faker->unique()->sentence(3);
            $newProject->slug = Str::of($newProject->title)->slug('-');
            $newProject->project_date = $faker->date();
            $newProject->content = $faker->text(200);
            $newProject->image = $faker->unique()->imageUrl();
            $newProject->save();
        }
    }
}