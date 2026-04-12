<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            // Project Info
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Client Info
            $table->string('client_name')->nullable();
            $table->string('location')->nullable();
            $table->string('tech_stack')->nullable(); // e.g. 1200.50 sqft
            $table->year('launch_year')->nullable();
            $table->decimal('project_budget', 15, 2)->nullable();
            $table->string('live_link')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
