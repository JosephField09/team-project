<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert sample data automatically after migration
        DB::table('categories')->insert([
            ['name' => 'Drinks', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pods', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beans', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pastries', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sweet Treats', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
    
};
