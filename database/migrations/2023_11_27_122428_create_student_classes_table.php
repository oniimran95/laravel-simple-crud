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
        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('t_class_id')->constrained();
            $table->string('reg_no');
            $table->string('roll_no');
            $table->enum('result', ['A+', 'A', 'A-', 'B', 'C', 'D', 'F']);
            $table->enum('status', ['running', 'completed', 'droped', 'rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_classes');
    }
};
