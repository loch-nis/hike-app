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
        Schema::create('personal_checklist_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('personal_checklist_id')
                ->constrained('personal_checklists')
                ->onDelete('cascade');
            $table->string('content');
            $table->boolean('is_checked')->default(false);
            $table->timestamp('checked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_checklist_items');
    }
};
