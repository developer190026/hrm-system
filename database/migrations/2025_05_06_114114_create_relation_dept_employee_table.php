<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Ensure the column is the correct type before adding FK
            $table->unsignedBigInteger('department_id')->change();
    
            $table->foreign('department_id')
                  ->references('id')
                  ->on('department')
                  ->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
    
};
