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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('image');
            $table->double('price', 5, 2);
            $table->string('duration');
            $table->text('content_en');
            $table->text('content_ar');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers', 'id')->nullOnDelete();
            // $table->bigIncrements('teacher_id')->references('teachers')->on('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
