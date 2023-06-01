<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillersTable extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        if (Schema::hasTable('fillers')) {
            return;
        }

        Schema::create('fillers', function (Blueprint $table) {
            $table->id();
            $table->string('filler');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fillers');
    }
}
