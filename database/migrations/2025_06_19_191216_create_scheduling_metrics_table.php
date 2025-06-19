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
        Schema::create('scheduling_metrics', function (Blueprint $table) {
            $table->id();
            $table->enum('algorithm_type', ['greedy', 'reinforcement_learning']);
            $table->integer('total_appointments');
            $table->integer('successful_bookings');
            $table->decimal('average_waiting_time', 8, 2)->comment('Average waiting time in minutes');
            $table->decimal('resource_utilization_rate', 5, 2)->comment('Utilization rate as percentage');
            $table->decimal('patient_satisfaction_score', 3, 2)->comment('Satisfaction score out of 5');
            $table->integer('execution_time_ms')->comment('Algorithm execution time in milliseconds');
            $table->date('date_recorded');
            $table->timestamps();

            // Indexes for better performance
            $table->index('algorithm_type');
            $table->index('date_recorded');
            $table->index(['algorithm_type', 'date_recorded']);
            $table->index('successful_bookings');
            $table->index('execution_time_ms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheduling_metrics');
    }
};
