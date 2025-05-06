<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $jsonPath = database_path('json\departments.json'); 

        if (!File::exists($jsonPath)) {
            $this->command->error("JSON file not found at: $jsonPath");
            return;
        }
        $json = File::get($jsonPath);
        $department = json_decode($json, true); // decode to array
            // Insert data using query builder (not Eloquent)
            foreach ($department as $department) {
                DB::table('department')->insert($department);
            }

            $this->command->info('Department seeded successfully.');

    }
}
