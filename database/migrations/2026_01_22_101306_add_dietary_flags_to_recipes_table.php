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
            // We add default(false) so they are unchecked by default
            
            if (!Schema::hasColumn('recipes', 'is_halal')) {
                $table->boolean('is_halal')->default(false);
            }
            
            if (!Schema::hasColumn('recipes', 'is_vegetarian')) {
                $table->boolean('is_vegetarian')->default(false);
            }
            
            if (!Schema::hasColumn('recipes', 'is_vegan')) {
                $table->boolean('is_vegan')->default(false);
            }
            
            if (!Schema::hasColumn('recipes', 'is_gluten_free')) {
                $table->boolean('is_gluten_free')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['is_halal', 'is_vegetarian', 'is_vegan', 'is_gluten_free']);
        });
    }
};