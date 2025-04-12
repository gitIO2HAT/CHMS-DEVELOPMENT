<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title'); // Event title
            $table->date('date'); // Event date
            $table->string('location'); // Event location
            $table->string('category'); // Event category
            $table->text('description'); // Event description
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
