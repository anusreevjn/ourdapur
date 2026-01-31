<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('recipes', function (Blueprint $table) {
        // Change column to string (255 characters)
        $table->string('cuisine', 255)->change();
    });
}

public function down()
{
    // Revert logic (optional, but good practice)
    // Adjust this line to match whatever your OLD definition was
    $table->string('cuisine', 10)->change(); 
}
};
