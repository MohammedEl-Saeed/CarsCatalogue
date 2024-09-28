<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('make');
        $table->string('model');
        $table->integer('year');
        $table->decimal('price', 10, 2);
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Assuming user authentication
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
