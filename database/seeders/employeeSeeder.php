<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Correct path using forward slashes
        $jsonPath = database_path('json\employee.json'); 

        // Make sure file exists
        if (!File::exists($jsonPath)) {
            $this->command->error("JSON file not found at: $jsonPath");
            return;
        }

        // Read and decode the JSON
        $json = File::get($jsonPath);
        $employees = json_decode($json, true); // decode to array

        // Insert data using query builder (not Eloquent)
        foreach ($employees as $employee) {
            DB::table('employees')->insert($employee);
        }

        $this->command->info('Employees seeded successfully.');
    }
}
