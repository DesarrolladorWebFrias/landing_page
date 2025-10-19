<?php
//Almacena los mensajes enviados por los usuarios a través del formulario de contacto.
//Tabla de logística para la comunicación con los usuarios.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 255);
            $table->string('phone', 50)->nullable();
            $table->string('subject', 255)->nullable();
            $table->text('message');
            $table->enum('status', ['new', 'in_progress', 'resolved'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->foreignId('responded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('responded_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};