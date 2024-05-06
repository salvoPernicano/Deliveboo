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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('name', 250);
            //rimosso unique dalla colonna name di dishes
            $table->text('description')->nullable();
            $table->decimal('price', 4, 2);
            $table->boolean('visible')->default(true);
            $table->enum('category', ['Giapponese', 'Italiana', 'Cinese', 'Messicano', 'Indiana'])->default('Italiana');
            $table->string("image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};

