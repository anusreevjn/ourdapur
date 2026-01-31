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
        Schema::table('recipes', function (Blueprint $table) {
            // We check if columns exist before adding them to prevent errors
            
            if (!Schema::hasColumn('recipes', 'cuisine')) {
                $table->string('cuisine')->nullable()->after('description');
            }

            if (!Schema::hasColumn('recipes', 'meal_type')) {
                $table->string('meal_type')->nullable()->after('cuisine');
            }

            if (!Schema::hasColumn('recipes', 'spice_level')) {
                $table->string('spice_level')->default('None')->after('meal_type');
            }
            
            // Adding other potential missing columns from your form
            if (!Schema::hasColumn('recipes', 'prep_time')) {
                $table->integer('prep_time')->nullable();
            }
            if (!Schema::hasColumn('recipes', 'cook_time')) {
                $table->integer('cook_time')->nullable();
            }
            if (!Schema::hasColumn('recipes', 'servings')) {
                $table->integer('servings')->nullable();
            }
            if (!Schema::hasColumn('recipes', 'calories')) {
                $table->integer('calories')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn([
                'cuisine', 
                'meal_type', 
                'spice_level', 
                'prep_time', 
                'cook_time', 
                'servings', 
                'calories'
            ]);
        });
    }
};