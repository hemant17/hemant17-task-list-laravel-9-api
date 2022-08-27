<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Subject (Text)
        // Description (Textarea)
        // Start Date (Date)
        // Due Date (Date)
        // Status (Enum: New, Incomplete, Complete)
        // Priority (Enum: High, Medium, Low)
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('description');
            $table->date('start_date');
            $table->date('due_date');
            $table->enum('status', ['New', 'Incomplete', 'Complete']);
            $table->enum('priority', ['High', 'Medium', 'Low']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
