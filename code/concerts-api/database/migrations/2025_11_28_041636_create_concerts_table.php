<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
{
    Schema::create('concerts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->foreignId('venue_id')->constrained('venues')->onDelete('cascade');
        $table->date('event_date');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}



    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
