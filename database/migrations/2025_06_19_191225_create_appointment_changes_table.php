<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->enum('change_type', ['reschedule', 'cancel', 'modify']);
            $table->date('old_date')->nullable();
            $table->time('old_time')->nullable();
            $table->date('new_date')->nullable();
            $table->time('new_time')->nullable();
            $table->text('reason')->nullable();
            $table->enum('handled_by_algorithm', ['greedy', 'ai_based']);
            $table->integer('processing_time_ms')->comment('Processing time in milliseconds');
            $table->timestamps();

            // Indexes for better performance
            $table->index('appointment_id');
            $table->index('change_type');
            $table->index('handled_by_algorithm');
            $table->index('processing_time_ms');
            $table->index(['appointment_id', 'change_type']);
            $table->index(['handled_by_algorithm', 'processing_time_ms'], 'alg_proc_time_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_changes');
    }
};
