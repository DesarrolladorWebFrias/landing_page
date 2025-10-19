<?php
//Almacena las diferentes versiones o el historial de cambios de una sección de la página.
//Esencial para la auditoría y la capacidad de deshacer cambios (rollback) en el contenido.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_section_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_versions');
    }
};