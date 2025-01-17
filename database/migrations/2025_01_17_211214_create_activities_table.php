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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id', 'activities_user_id')->onDelete('set null');
            $table->string('user_name')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('headers')->nullable();
            $table->string('request_path')->nullable();
            $table->string('request_method')->nullable();
            $table->tinyText('request_body')->nullable();
            $table->string('message')->nullable();
            $table->tinyText('response_body')->nullable();
            $table->tinyText('errors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
