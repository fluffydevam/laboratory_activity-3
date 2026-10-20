<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 25);
            $table->string('email', 100);
            $table->string('phone_number', 20)->nullable();
            $table->date('hire_date');
            $table->foreignId('job_id')->constrained('jobs', 'job_id')->onDelete('cascade');
            $table->decimal('salary', 8, 2);
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments', 'department_id')->onDelete('cascade');

            // Self-referencing foreign key for manager
            $table->foreign('manager_id')->references('employee_id')->on('employees')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('employees');
    }
};
