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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->date('birthday')->nullable();
            $table->year('leave_year')->nullable();
            $table->year('join_year')->nullable();
            $table->string('current_job', 100)->nullable();
            $table->string('current_company', 100)->nullable();
            $table->string('address',100)->nullable();
            $table->string('city',50);
            $table->string('state',50);
            $table->string('no_hp',15)->nullable();
            $table->string('linkedin',100)->nullable();
            $table->string('profile_pic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
