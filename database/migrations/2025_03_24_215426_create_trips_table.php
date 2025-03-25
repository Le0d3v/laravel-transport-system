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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->date("output_date");
            $table->time("output_time");
            $table->date("arrival_date");
            $table->time("arrival_time");
            $table->foreignId("origin")
                ->constrained("terminals")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreignId("destination")
                ->constrained("terminals")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreignId("truck_id")->constrained()->onDelete("cascade");
            $table->integer("seatings");
            $table->integer("availables");
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
