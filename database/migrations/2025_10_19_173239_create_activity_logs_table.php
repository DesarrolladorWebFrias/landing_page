<?php

//Almacena un registro de todas las acciones importantes realizadas por los usuarios (ej. "Admin modificó la página 'Home'").
//Esencial para la seguridad, la auditoría y el rastreo de errores.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_name', 100)->default('default');
            $table->text('description');
            $table->string('subject_type', 150)->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('causer_type', 150)->nullable();
            $table->unsignedBigInteger('causer_id')->nullable();
            $table->json('properties')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['subject_type', 'subject_id']);
            $table->index(['causer_type', 'causer_id']);
            $table->index('log_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};