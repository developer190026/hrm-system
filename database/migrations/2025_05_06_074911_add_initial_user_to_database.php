<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Check if the user already exists before creating a new one
        if (User::where('email', 'developer190026@gmail.com')->doesntExist()) {
            // Create a new user instance if it doesn't exist
            $user = new User();
            $user->name = "Bindu";
            $user->email = "developer190026@gmail.com";
            $user->role = "admin";
            $user->password = bcrypt("admin@12345"); // Make sure to hash the password
            $user->save();
        }

        if (User::where('email', 'bindu@gmail.com')->doesntExist()) {
            // Create a new user instance if it doesn't exist
            $user = new User();
            $user->name = "Emp Bindu";
            $user->email = "bindu@gmail.com";
            $user->role = "employee";
            $user->password = bcrypt("admin@12345"); // Make sure to hash the password
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('database', function (Blueprint $table) {
            //
        });
    }
};
