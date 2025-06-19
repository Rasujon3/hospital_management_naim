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
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('notification_type')->comment('Type of notification like appointment_reminder, schedule_change etc');
            $table->enum('channel', ['database', 'email', 'broadcast', 'sms'])->comment('Notification delivery channel');
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();

            // Indexes for better performance
            $table->index('user_id');
            $table->index('notification_type');
            $table->index('channel');
            $table->index('is_enabled');
            $table->index(['user_id', 'notification_type']);
            $table->index(['user_id', 'channel', 'is_enabled']);

            // Unique constraint to prevent duplicate settings
            $table->unique(['user_id', 'notification_type', 'channel']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_settings');
    }
};
