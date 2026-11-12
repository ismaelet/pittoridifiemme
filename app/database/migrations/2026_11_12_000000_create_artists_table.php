<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Mirrors the legacy schema; skipped when the tables already exist (production).
    public function up(): void
    {
        if (Schema::hasTable('artists')) {
            return;
        }

        Schema::create('artists', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('fname', 30)->default('');
            $table->string('lname', 30)->default('');
            $table->string('fname2', 30)->default('');
            $table->string('lname2', 30)->default('');
            $table->string('place', 30)->default('');
            $table->string('bio', 500)->default('');
            $table->string('date', 30)->default('');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('artID')->index();
            $table->boolean('main')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('artists');
    }
};
