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
    Schema::create('recipes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who posted it?
        $table->string('title');
        $table->text('description');
        $table->text('ingredients'); // We will store ingredients as a simple text list for now
        $table->text('instructions');
        
        
        // FILTERS
        $table->enum('cuisine', ['Malaysian', 'Indonesian', 'Korean', 'Japanese', 'Western', 'Other']);
        $table->enum('meal_type', ['Breakfast', 'Lunch', 'Dinner', 'Snack', 'Dessert', 'Drink']);
        $table->string('difficulty')->default('Medium'); // Easy, Medium, Hard
        $table->integer('portion_size')->default(2); // Number of people
        
        $table->string('image_url')->nullable(); // For photos
        $table->boolean('is_ai_generated')->default(false); // To mark AI suggestions
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
