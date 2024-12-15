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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('endpoint');
            $table->string('method');
            $table->json('request_payload');
            $table->json('response_payload');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('token_id')->nullable()->constrained('api_tokens');
            $table->timestamps();
            $table->string('created_pg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
